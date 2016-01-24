<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\RoomType;
use Doctrine\ORM\Query\ResultSetMapping;
use AppBundle\Entity\Reservation;
use DateTime;
use AppBundle\Entity\User;

class BookingController extends Controller
{
	/**
	 * Reservation.
	 *
	 * @Route("/booking", name="booking")
	 * @Method("GET")
	 * @Template()
	 */
	
	public function indexAction(Request $request) 
	{	
		$em = $this->getDoctrine()->getManager();
		
		$roomTypes = $em->getRepository('AppBundle:RoomType')->findAll();
		return $this->render('AppBundle:Booking:reservation.html.twig', array('roomTypes' => $roomTypes));
	}
	
	/**
	 * Add Reservation.
	 *
	 * @Route("/add_reservation", name="add_reservation")
	 * @Method("POST")
	 * @Template()
	 */
	
	public function addReservationAction(Request $request)
	{
		if ($request->getMethod() == 'POST') {
			$checkinDate = $request->get('checkinDate');
			$checkoutDate = $request->get('checkoutDate');
			$roomId = $request->get('selectedRoomId');
			
			$reservation = new Reservation();
			$reservation->setCheckinDate(new DateTime($checkinDate));
			$reservation->setCheckoutDate(new DateTime($checkoutDate));						
			
			$em = $this->getDoctrine()->getManager();			
			$user = $em->getRepository('AppBundle:User')->find($this->getRequest()->getSession()->get('currentUserInfo')->getId());
			$reservation->setUser($user);
			$status = $em->getRepository('AppBundle:ReservationStatus')->find(1);
			$room = $em->getRepository('AppBundle:Room')->find($roomId);
			$reservation->setStatus($status);
			$reservation->setRoom($room);
			
			$em->persist($reservation);
			$em->flush();
			
			$cancelReservationUrl = "http://localhost:81/SymfonyPractice/Hotel/web/app_dev.php/cancel_reservation/". $reservation->getId();
			
			$message = \Swift_Message::newInstance()
			->setSubject('Majestic Reservation!')
			->setFrom(array('m.maria_negrea@yahoo.com' => "Majestic Hotel"))
			->setTo($user->getEmail())
			->setCharset("utf-8")
			->setContentType('text/html')
			->setBody("<h1>Hello, ". $user->getFirstName(). "! Your reservation at Majestic Hotel has been confirmed. If by any reason you want to cancel the reservation, please click the link above:</h1><br><a href='".$cancelReservationUrl."'>Cancel Reservation</a>");
			$this->get('mailer')->send($message);
				
			return $this->redirect($this->generateUrl('mainPage'));
		}
		return $this->render('AppBundle:Booking:reservation.html.twig');
	}
	
	/**
	 * Get available rooms.
	 *
	 * @Route("/getrooms", name="getrooms")
	 * @Method("POST")
	 * @Template()
	 */
	public function getroomsAction()
	{
		$checkinDate = $_POST['checkinDate'];		
		$checkoutDate = $_POST['checkoutDate'];
		$roomTypeId = $_POST['roomTypeId'];		
		$hasWireless = $_POST['hasWireless'];
		$hasTV = $_POST['hasTV'];
		$hasAirConditioning = $_POST['hasAirConditioning'];
		$hasMinibar = $_POST['hasMinibar'];
				
		$stmt = $this->getDoctrine()->getEntityManager()
		->getConnection()
		->prepare("SELECT r.* FROM room r JOIN room_type rt ON r.room_type_id = rt.id WHERE rt.id = :roomTypeId AND r.id not in (SELECT r.id FROM room r JOIN reservation rv ON rv.room_id = r.id WHERE (:checkinDate <= rv.checkout_date AND :checkoutDate >= checkin_date) AND rv.status_id != 2)");
		$params['roomTypeId'] = $roomTypeId;
		/* $params['hasWireless'] = $hasWireless;
		$params['hasTV'] = $hasTV;
		$params['hasAirConditioning'] = $hasAirConditioning;
		$params['hasMinibar'] = $hasMinibar; */
		$params['checkinDate'] = $checkinDate;
		$params['checkoutDate'] = $checkoutDate;
		$stmt->execute($params);
		$result = $stmt->fetchAll();
		
		return $this->render('AppBundle:Booking:rooms.html.twig', array('rooms' => $result));
	}
	
	/**
	 * Cancel reservation.
	 *
	 * @Route("/cancel_reservation/{id}", name="cancel_reservation")
	 * @Method("GET")
	 * @Template()
	 */
	public function cancelReservationAction(Request $request, $id)
	{
		$session = $this->getRequest()->getSession();
		$session->set('canceledReservationId', $id);
		
		if($session->get("currentUserInfo") == null)
		{
			return $this->redirect($this->generateUrl('login'));
		}		
		
		$em = $this->getDoctrine()->getManager();
		$reservation = $em->getRepository('AppBundle:Reservation')->find($id);
		$confirmedStatus = $em->getRepository('AppBundle:ReservationStatus')->find(1);
		if($reservation && $reservation->getStatus() == $confirmedStatus)
		{
			$status = $em->getRepository('AppBundle:ReservationStatus')->find(2);
			$reservation->setStatus($status);
			
			$em->merge($reservation);
			$em->flush();
		}
		
		$session->remove('canceledReservationId');
		return $this->redirect($this->generateUrl('mainPage'));
	}
	
	/**
	 * Checkin.
	 *
	 * @Route("/checkinfinal", name="checkinfinal")
	 * @Method("POST")
	 * @Template()
	 */
	public function checkinFinalAction(Request $request)
	{
		if ($request->getMethod() == 'POST') {
			
			$id = $request->get('reservationId');
			$session = $this->getRequest()->getSession();
			if($session->get("currentUserInfo") == null || $session->get("currentUserInfo")->getIsReceptionist() == false)
			{
				return $this->redirect($this->generateUrl('login'));
			}
			
			$em = $this->getDoctrine()->getManager();
			$reservation = $em->getRepository('AppBundle:Reservation')->find($id);
			$confirmedStatus = $em->getRepository('AppBundle:ReservationStatus')->find(1);
			if($reservation && $reservation->getStatus() == $confirmedStatus)
			{
				$status = $em->getRepository('AppBundle:ReservationStatus')->find(3);
				$reservation->setStatus($status);
			
				$em->merge($reservation);
				$em->flush();
			}
		}	
		
		return $this->redirect($this->generateUrl('mainPage'));
	}
	
	/**
	 * Checkout.
	 *
	 * @Route("/checkoutfinal", name="checkoutfinal")
	 * @Method("POST")
	 * @Template()
	 */
	public function checkoutFinalAction(Request $request)
	{	
		if ($request->getMethod() == 'POST') {
			
			$id = $request->get('reservationId');		
			$session = $this->getRequest()->getSession();
			if($session->get("currentUserInfo") == null || $session->get("currentUserInfo")->getIsReceptionist() == false)
			{
				return $this->redirect($this->generateUrl('login'));
			}
		
			$em = $this->getDoctrine()->getManager();
			$reservation = $em->getRepository('AppBundle:Reservation')->find($id);
			$checkedinStatus = $em->getRepository('AppBundle:ReservationStatus')->find(3);
			if($reservation && $reservation->getStatus() == $checkedinStatus)
			{
				$status = $em->getRepository('AppBundle:ReservationStatus')->find(4);
				$reservation->setStatus($status);
					
				$em->merge($reservation);
				$em->flush();
			}
		}
		
		return $this->redirect($this->generateUrl('mainPage'));
	}
	
	/**
	 * Checkout reservation.
	 *
	 * @Route("/findReservation", name="findReservation")
	 * @Method("POST")
	 * @Template()
	 */
	
	public function findReservationAction(Request $request)
	{
		if ($request->getMethod() == 'POST') {
			$email = $request->get('emailReservation');
			$status = $request->get('status');
			
			$em = $this->getDoctrine()->getManager();			
			if($status == "checkin")
			{
				$reservationStatusId = 1;
			}
			else
			{
				$reservationStatusId = 3;
			}
			
			$reservationStatus = $em->getRepository('AppBundle:ReservationStatus')->find($reservationStatusId);
			$user = $em->getRepository("AppBundle:User")->findBy(array("email" => $email));			
			if($user)
			{
				$reservations = $em->getRepository("AppBundle:Reservation")->findBy(array("user" => $user, "status" => $reservationStatus));
				
				return $this->render('AppBundle:Receptionist:getReservations.html.twig', array('reservations' => $reservations, "status" =>$status));
			}			
			
			return $this->redirect($this->generateUrl('mainPage'));
		}
	}
}