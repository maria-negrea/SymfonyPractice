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
		return $this->render('AppBundle:Receptionist:checkin.html.twig');
	}
	
	/**
	 * Check out.
	 *
	 * @Route("/checkout", name="checkout")
	 * @Template()
	 */
	public function checkoutAction()
	{
		return $this->render('AppBundle:Receptionist:checkout.html.twig');
	}
	
}