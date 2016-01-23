<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class AdminController extends Controller{
	
	/**
	 * Block users.
	 *
	 * @Route("/blockUsers", name="blockUsers")
	 * @Template()
	 */
	public function blockUsersAction()
	{
		return $this->render('AppBundle:Admin:blockUsers.html.twig');
	}
	
}