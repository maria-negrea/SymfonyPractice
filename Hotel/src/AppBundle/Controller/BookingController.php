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
		$params['checkinDate'] = $checkoutDate;
		$params['checkoutDate'] = $checkoutDate;


		$stmt->execute($params);
		$result = $stmt->fetchAll();
		
		return $this->render('AppBundle:Booking:rooms.html.twig', array('rooms' => $result));
	}
}