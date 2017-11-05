<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 05.11.2017
 * Time: 01:56
 */

namespace AppBundle\Security;


use AppBundle\Form\UserLogin;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Guard\Authenticator\AbstractFormLoginAuthenticator;

class LoginFormAuthenticator extends AbstractFormLoginAuthenticator
{

	/**
	 * @var FormFactoryInterface
	 */
	private $formFactory;

	public function __construct(FormFactoryInterface $formFactory)
	{
		$this->formFactory = $formFactory;
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

		dump($data);die;
	}


	protected function getLoginUrl()
	{
		// TODO: Implement getLoginUrl() method.
	}


	public function getUser($credentials, UserProviderInterface $userProvider)
	{
		// TODO: Implement getUser() method.
	}

	public function checkCredentials($credentials, UserInterface $user)
	{
		// TODO: Implement checkCredentials() method.
	}

}