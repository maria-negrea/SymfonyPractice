<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;




class AdminController extends Controller{
	
	/**
	 * Users.
	 *
	 * @Route("/users", name="users")
	 * @Template()
	 */
	public function usersAction()
	{
		return $this->redirect($this->generateUrl('user'));
	}
	
	/**
	 * Rooms.
	 *
	 * @Route("/rooms", name="rooms")
	 * @Template()
	 */
	public function roomsActions()
	{
		return $this->redirect($this->generateUrl('room'));
	}
	
}