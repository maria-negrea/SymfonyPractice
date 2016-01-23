<?php
namespace AppBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use AppBundle\Entity\User;




class HomeController extends Controller{
	
	/**
	 * Index.
	 *
	 * @Route("/", name="mainPage")
	 * @Template()
	 */
	public function indexAction()
	{
		$currentUser = $this->get('session')->get('currentUserInfo');
		if($currentUser)
		{
			$isAdmin = $currentUser->getIsAdmin();
			if($isAdmin)
			{
				return $this->render('AppBundle:Admin:adminMainPage.html.twig');
			}
			
			$isReceptionist = $currentUser->getIsReceptionist();
			if($isReceptionist)
			{
				return $this->render('AppBundle:Receptionist:receptionistMainPage.html.twig');
			}
		}
		
			
		return $this->render('AppBundle:Home:mainPage.html.twig');
	}

	/**
	 * Login.
	 *
	 * @Route("/login", name="login")
	 * @Template()
	 */
	public function loginAction(Request $request)
	{
		$session = $this->getRequest()->getSession();
		$em = $this->getDoctrine()->getEntityManager();
		$repository = $em->getRepository('AppBundle:User');
		
		if ($request->getMethod() == 'POST') {
			
			$session->clear();
			$email = $request->get('email');
			$password = sha1($request->get('password'));
			/* $remember = $request->get('remember'); */
			$user = $repository->findOneBy(array('email' => $email, 'password' => $password));
			if ($user) {
				
				$session->set('currentUserInfo', $user);
				
				return $this->redirect($this->generateUrl('mainPage'));
				
			} else {
				return $this->render('AppBundle:Home:login.html.twig');
			}
		} else {
			
			return $this->render('AppBundle:Home:login.html.twig');
		}
	}
	
	
	/**
	 * Register.
	 *
	 * @Route("/register", name="register")
	 * @Template()
	 */
	
	public function registerAction(Request $request)
	{
		if ($request->getMethod() == 'POST') {
			$email = $request->get('email');
			$password = $request->get('password');
			$firstName = $request->get('firstName');
			$lastName = $request->get('lastName');
			$telephoneNumber = $request->get('telephoneNumber');
			$cardNumber = $request->get('cardNumber');
		
			$user = new User();
			$user->setEmail($email);
			$user->setPassword(sha1($password));
			$user->setFirstName($firstName);
			$user->setLastName($lastName);
			$user->setTelephoneNumber($telephoneNumber);
			$user->setCardNumber($cardNumber);
			$user->setIsAdmin(false);
			$user->setIsBlocked(false);
			$user->setIsReceptionist(false);
			
			$em = $this->getDoctrine()->getEntityManager();
			$em->persist($user);
			$em->flush();
			
			$session = $this->getRequest()->getSession();
			$session->set('currentUserInfo', $user);			
			
			return $this->render('AppBundle:Home:mainPage.html.twig');
		}
		return $this->render('AppBundle:Home:register.html.twig');
	}
	
	/**
	 * Register.
	 *
	 * @Route("/logout", name="logout")
	 * @Template()
	 */
	
	public function logoutAction(Request $request) {
		$session = $this->getRequest()->getSession();
		$session->clear();
		
		return $this->redirect($this->generateUrl('mainPage'));
	}
	
	/**
	 * Description.
	 *
	 * @Route("/description", name="description")
	 * @Template()
	 */
	
	public function descriptionAction()
	{
		return $this->render('AppBundle:Home:description.html.twig');
	}
	
	/**
	 * Images.
	 *
	 * @Route("/images", name="images")
	 * @Template()
	 */
	public function imagesAction()
	{
		return $this->render('AppBundle:Home:images.html.twig');
	}
}