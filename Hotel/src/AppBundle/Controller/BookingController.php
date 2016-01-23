<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\RoomType;

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
	 * @Method("GET")
	 * @Template()
	 */
	
	public function addReservationAction(Request $request)
	{
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
		$roomTypeId = $_POST['$roomTypeId'];
		$hasWireless = $_POST['$hasWireless'];
		$hasTV = $_POST['$hasTV'];
		$hasAirConditioning = $_POST['$hasAirConditioning'];
		$hasMinibar = $_POST['$hasMinibar'];
		
		
		if(isset($checkinDate) && !empty($checkinDate) && isset($checkoutDate) && !empty($checkoutDate) && isset($roomTypeId) && !empty($roomTypeId))  
		{
			$em = $this->getDoctrine()->getManager();
			$query = $em->createQuery("SELECT r.* FROM room r JOIN room_type rt ON r.room_type_id = rt.id WHERE rt.id = :roomTypeId AND has_wireless = :hasWireless AND has_tv = :hasTV AND tas_air_conditioning = :hasAirConditioning AND has_minibar =:hasMinibar AND r.id not in (SELECT r.id FROM room r JOIN reservation rv ON rv.room_id = r.id WHERE (:checkinDate < rv.checkout_date AND :checkoutDate > checkin_date) AND rv.status_id != 2)");
			$query->setParameters(array(
					'roomTypeId' => $roomTypeId,
					'checkinDate' => $checkinDate,
					'checkoutDate' => $checkoutDate,
					'hasWireless' => $hasWireless,
					'hasTV' => $hasTV,
					'hasAirConditioning' => $hasAirConditioning,
					'hasMinibar' => $hasMinibar
			));
			$rooms = $query->getResult();
			
			return $rooms;
		}
		
		return "dfdf";
		
	}
}