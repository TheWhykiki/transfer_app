<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 05.11.2017
 * Time: 01:56
 */

namespace AppBundle\Security;


use AppBundle\Form\UserLogin;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Util\TargetPathTrait;
use Symfony\Component\HttpFoundation\RedirectResponse;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

	/**
	 * @var FormFactoryInterface
	 */
	private $formFactory;
	/**
	 * @var RouterInterface
	 */
	private $router;

	public function __construct(FormFactoryInterface $formFactory, EntityManager $em, RouterInterface $router)
	{
		$this->formFactory = $formFactory;
		$this->em = $em;
		$this->router = $router;
	}

	public function getCredentials(Request $request)
	{
		$isLoginSubmitted = $request->getPathInfo() == "/login" && $request->isMethod('POST');
		if(!$isLoginSubmitted){
			return;
		}

		$form = $this->formFactory->create(UserLogin::class);
		$form->handleRequest($request);
		$data = $form->getData();

		$request->getSession()->set(
			Security::LAST_USERNAME,
			$data['_username']
		);


		return $data;
	}

	public function getUser($credentials, UserProviderInterface $userProvider)
	{
		$username = $credentials['_username'];
		return $this->em->getRepository('AppBundle:User')
						->findOneBy([
							'email' => $username
						]);
	}

	public function checkCredentials($credentials, UserInterface $user)
	{
		$password = $credentials['_password'];
		if($password == 'kiki'){
			return true;
		}
		return false;
	}


	protected function getLoginUrl()
	{
		return $this->router->generate('user_login');
	}

	use TargetPathTrait;

	public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
	{
		// if the user hits a secure page and start() was called, this was
		// the URL they were on, and probably where you want to redirect to
		$targetPath = $this->getTargetPath($request->getSession(), $providerKey);

		if (!$targetPath) {
			$targetPath = $this->router->generate('homepage');
		}

		return new RedirectResponse($targetPath);
	}


}