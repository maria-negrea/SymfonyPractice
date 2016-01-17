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
	 * @Route("/welcome", name="mainPage")
	 * @Template()
	 */
	public function indexAction()
	{
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
				/* if ($remember == 'remember-me') {
					$login = new Login();
					$login->setUsername($username);
					$login->setPassword($password);
					$session->set('login', $login);
				} */
				
				$session->set('currentUserInfo', $user);
				return $this->render('AppBundle:Home:mainPage.html.twig', array('name' => $user->getFirstName()));
			} else {
				return $this->render('AppBundle:Home:login.html.twig', array('name' => 'Login Error'));
			}
		} else {
			/* if ($session->has('login')) {
				$login = $session->get('login');
				email = $login->getEmail();
				$password = $login->getPassword();
				$user = $repository->findOneBy(array('userName' => $username, 'password' => $password));
				if ($user) {
					
					return $this->render('LoginLoginBundle:Default:welcome.html.twig', array('name' => $user->getFirstName(),'countries'=>$countries,'total_pages'=>$total_pages,'current_page'=> $page));
				}
			} */
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
			
			return $this->render('AppBundle:Home:mainPage.html.twig');
		}
		return $this->render('AppBundle:Home:register.html.twig');
	}
	
	public function logoutAction(Request $request) {
		$session = $this->getRequest()->getSession();
		$session->clear();
		return $this->render('AppBundle:Home:mainPage.html.twig');
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