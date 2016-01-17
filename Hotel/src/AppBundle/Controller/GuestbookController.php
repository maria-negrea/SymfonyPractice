<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class GuestbookController extends Controller 
{
/**
	 * Reservation.
	 *
	 * @Route("/guestbook", name="guestbook")
	 * @Method("GET")
	 * @Template()
	 */
	
	public function indexAction() 
	{
		return $this->render('AppBundle:Guestbook:guestbook.html.twig');
	}

}