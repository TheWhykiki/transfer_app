<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 05.11.2017
 * Time: 00:48
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;



/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 */
class User implements UserInterface
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", unique=true)
	 */
	private $email;

	public function getUsername()
	{
		return $this->email;
	}

	public function getRoles()
	{
		return['USER'];
	}

	public function getPassword()
	{
		// TODO: Implement getPassword() method.
	}

	public function getSalt()
	{
		// TODO: Implement getSalt() method.
	}

	public function eraseCredentials()
	{
		// TODO: Implement eraseCredentials() method.
	}

}