<?php
namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


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
	
	/**
	 * Find users.
	 *
	 * @Route("/findUsers", name="findUsers")
	 * @Template()
	 */
	public function findUsersAction()
	{				
		$stmt = $this->getDoctrine()->getEntityManager()
		->getConnection()
		->prepare("SELECT * FROM user WHERE id IN (SELECT DISTINCT user_id from reservation WHERE checkout_date < now() AND ( status_id = 3 OR status_id = 1))");

		$stmt->execute();
		$users = $stmt->fetchAll();
		
		return $this->render('AppBundle:Admin:getUsers.html.twig', array('users' => $users));
	}
	
	/**
	 * Block user.
	 *
	 * @Route("/blockUser", name="blockUser")
	 * @Method("POST")
	 * @Template()
	 */
	public function blockUserAction(Request $request)
	{
		if ($request->getMethod() == 'POST') {
			
			$userId = $request->get('id');
			
			$em = $this->getDoctrine()->getManager();
			$user = $em->getRepository("AppBundle:User")->findOneBy(array("id" => $userId));
			if($user)
			{
				$user->setIsBlocked(true);
				$em->merge($user);
				$em->flush();
				
				$reservations = $em->getRepository('AppBundle:Reservation')->findBy(array("user" =>$user));
				if($reservations)
				{
					foreach ($reservations as $reservation) {
						$em->remove($reservation);
					}
					
					$em->flush();
				}
			}
			
			
			return $this->redirect($this->generateUrl('mainPage'));
		}
	}
	
	
	
}