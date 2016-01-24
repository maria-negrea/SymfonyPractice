<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class ReceptionistController extends Controller{
	
	/**
	 * Check n.
	 *
	 * @Route("/checkin", name="checkin")
	 * @Template()
	 */
	public function checkinAction()
	{
		return $this->render('AppBundle:Receptionist:findReservation.html.twig', array("status" => "checkin"));
	}
	
	/**
	 * Check out.
	 *
	 * @Route("/checkout", name="checkout")
	 * @Template()
	 */
	public function checkoutAction()
	{
		return $this->render('AppBundle:Receptionist:findReservation.html.twig', array("status" => "checkout"));
	}
	
}