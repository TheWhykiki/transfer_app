<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 29.12.2017
 * Time: 16:40
 */

namespace FahrzeugdatenblattBundle\Controller;
use FahrzeugdatenblattBundle\Entity\Fahrzeugdatenblatt;
use FahrzeugdatenblattBundle\Entity\Transferfahrten;
use FahrzeugdatenblattBundle\Form\TransferfahrtenForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Core\Authentication\Token\UsernamePasswordToken;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;

class CheckoutController extends Controller
{

	/************************************************************************************************************************
	 *
	 * Checkout Controller
	 *
	 ***********************************************************************************************************************/

	/**
	 *
	 * @Route("/checkout", options={"expose"=true}, name="checkout")
	 */

	public function checkoutAction(Request $request, UserInterface $user){
        $userId = $user->getId();
        //$username = $request->request->get('username');

		//$username = "adminuse2r";
		//$password = "test2";

		$userLoggedState = $this->ajaxLoginAction($request);
		//$this->login()->user->getUsername();
		//dump($userLoggedState);die;

		return $this->render('frontend_templates/checkout_step1.html.twig',[
			'daten' => $userLoggedState,
            'id' => $userId
		]);

	}

	public function login(Request $request, $username, $password)
	{

		// Retrieve the security encoder of symfony
		$factory = $this->get('security.encoder_factory');

		/// Start retrieve user
		// Let's retrieve the user by its username:
		// If you are using FOSUserBundle:
		$user_manager = $this->get('fos_user.user_manager');
		$user = $user_manager->findUserByUsername($username);

		// Check if the user exists !
		if(!$user){
			$userstate = [
				'state' => false,
				'message' => 'User existiert nicht',
			];
			return $userstate;
		}

		/// Start verification
		$encoder = $factory->getEncoder($user);
		$salt = $user->getSalt();

		if(!$encoder->isPasswordValid($user->getPassword(), $password, $salt)) {
			$userstate = [
				'state' => false,
				'message' => 'Username oder Passwort nich korrekt',
			];
			return $userstate;
		}
		/// End Verification

		// The password matches ! then proceed to set the user in session

		//Handle getting or creating the user entity likely with a posted form
		// The third parameter "main" can change according to the name of your firewall in security.yml
		$token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
		$this->get('security.token_storage')->setToken($token);

		// If the firewall name is not main, then the set value would be instead:
		// $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
		$this->get('session')->set('_security_main', serialize($token));

		// Fire the login event manually
		$event = new InteractiveLoginEvent($request, $token);
		$this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

		/*
		 * Now the user is authenticated !!!!
		 * Do what you need to do now, like render a view, redirect to route etc.
		 */

		$userstate = [
			'state' => true,
			'message' => 'User eingeloggt',
			'username' => $user->getUsername()
			];
		return $userstate;
	}

	/************************************************************************************************************************
	 *
	 * Checkout Controller
	 *
	 ***********************************************************************************************************************/

	/**
	 *
	 * @Route("/ajax_login_action", name="ajax_login_action")
	 * @Method("POST")
	 */

	public function ajaxLoginAction(Request $request)
	{
		$username = $request->request->get('username');
		$password = $request->request->get('password');
		// Retrieve the security encoder of symfony
		$factory = $this->get('security.encoder_factory');

		/// Start retrieve user
		// Let's retrieve the user by its username:
		// If you are using FOSUserBundle:
		$user_manager = $this->get('fos_user.user_manager');
		$user = $user_manager->findUserByUsername($username);

		// Check if the user exists !
		if(!$user){
			$userstate = [
				'state' => false,
				'message' => 'User existiert nicht',
			];
			return New JsonResponse($userstate);
		}

		/// Start verification
		$encoder = $factory->getEncoder($user);
		$salt = $user->getSalt();

		if(!$encoder->isPasswordValid($user->getPassword(), $password, $salt)) {
			$userstate = [
				'state' => false,
				'message' => 'Username oder Passwort nich korrekt',
			];
			return New JsonResponse($userstate);
		}
		/// End Verification

		// The password matches ! then proceed to set the user in session

		//Handle getting or creating the user entity likely with a posted form
		// The third parameter "main" can change according to the name of your firewall in security.yml
		$token = new UsernamePasswordToken($user, null, 'main', $user->getRoles());
		$this->get('security.token_storage')->setToken($token);

		// If the firewall name is not main, then the set value would be instead:
		// $this->get('session')->set('_security_XXXFIREWALLNAMEXXX', serialize($token));
		$this->get('session')->set('_security_main', serialize($token));

		// Fire the login event manually
		$event = new InteractiveLoginEvent($request, $token);
		$this->get("event_dispatcher")->dispatch("security.interactive_login", $event);

		/*
		 * Now the user is authenticated !!!!
		 * Do what you need to do now, like render a view, redirect to route etc.
		 */

		$userstate = [
			'state' => true,
			'message' => 'User eingeloggt',
			'username' => $user->getUsername()
		];
		return New JsonResponse($userstate);


	}
}