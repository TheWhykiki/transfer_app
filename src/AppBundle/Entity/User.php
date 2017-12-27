<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 05.11.2017
 * Time: 00:48
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * @ORM\Entity
 * @ORM\Table(name="user")
 * @UniqueEntity(fields={"email"}, message="Sie sind bereits registriert")
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
 * @ORM\Column(type="string")
 */
	private $password;

	/**
	 * @ORM\Column(type="boolean")
	 */
	private $enabled;

	/**
	 * @return mixed
	 */
	public function getEnabled()
	{
		return $this->enabled;
	}

	/**
	 * @param mixed $enabled
	 */
	public function setEnabled($enabled)
	{
		$this->enabled = $enabled;
	}

	/**
	*@Assert\NotBlank(groups={"Register"})
	 */

	private $plainPassword;


	/**
	 * @ORM\Column(type="json_array")
	 */
	private $roles = [];

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $gender;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $name;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $surname;

	/**
	 * @ORM\Column(type="string" , nullable=true)
	 */
	private $street;

	/**
	 * @ORM\Column(type="string" , nullable=true)
	 */
	private $zipcode;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $city;

	/**
	 * @ORM\Column(type="string", nullable=true)
	 */
	private $phone;

	/**
	 *@Assert\NotBlank()
	 * @Assert\Email()
	 * @ORM\Column(type="string", unique=true)
	 */
	private $email;

	/**
	 * @return mixed
	 */
	public function getPlainPassword()
	{
		return $this->plainPassword;
	}

	/**
	 * @param mixed $plainPassword
	 */
	public function setPlainPassword($plainPassword)
	{
		$this->plainPassword = $plainPassword;
		$this->password = null;
	}



	/**
	 * @return mixed
	 */
	public function getId()
	{
		return $this->id;
	}

	/**
	 * @return mixed
	 */
	public function getGender()
	{
		return $this->gender;
	}

	/**
	 * @param mixed $gender
	 */
	public function setGender($gender)
	{
		$this->gender = $gender;
	}

	/**
	 * @return mixed
	 */
	public function getName()
	{
		return $this->name;
	}

	/**
	 * @param mixed $name
	 */
	public function setName($name)
	{
		$this->name = $name;
	}

	/**
	 * @return mixed
	 */
	public function getSurname()
	{
		return $this->surname;
	}

	/**
	 * @param mixed $surname
	 */
	public function setSurname($surname)
	{
		$this->surname = $surname;
	}

	/**
	 * @return mixed
	 */
	public function getStreet()
	{
		return $this->street;
	}

	/**
	 * @param mixed $street
	 */
	public function setStreet($street)
	{
		$this->street = $street;
	}

	/**
	 * @return mixed
	 */
	public function getZipcode()
	{
		return $this->zipcode;
	}

	/**
	 * @param mixed $zipcode
	 */
	public function setZipcode($zipcode)
	{
		$this->zipcode = $zipcode;
	}

	/**
	 * @return mixed
	 */
	public function getCity()
	{
		return $this->city;
	}

	/**
	 * @param mixed $city
	 */
	public function setCity($city)
	{
		$this->city = $city;
	}

	/**
	 * @return mixed
	 */
	public function getPhone()
	{
		return $this->phone;
	}

	/**
	 * @param mixed $phone
	 */
	public function setPhone($phone)
	{
		$this->phone = $phone;
	}

	/**
	 * @return mixed
	 */
	public function getEmail()
	{
		return $this->email;
	}

	/**
	 * @param mixed $email
	 */
	public function setEmail($email)
	{
		$this->email = $email;
	}



	public function getUsername()
	{
		return $this->email;
	}

	public function getRoles()
	{
		$roles = $this->roles;
		if(!in_array('ROLE_USER', $roles)){
			$roles[] = 'ROLE_USER';
		}
		return $roles;
	}

	/**
	 * @param mixed $password
	 */
	public function setPassword($password)
	{
		$this->password = $password;
	}

	public function getPassword()
	{
		return $this->password;
	}

	public function getSalt()
	{
		// TODO: Implement getSalt() method.
	}

	public function eraseCredentials()
	{
		$this->plainPassword = null;
	}

	public function setRoles($roles)
	{
		$this->roles = $roles;
	}



}