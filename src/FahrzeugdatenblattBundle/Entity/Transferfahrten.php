<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 31.10.2017
 * Time: 16:54
 */

namespace FahrzeugdatenblattBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="FahrzeugdatenblattBundle\Repository\TransferfahrtenRepository")
 * @ORM\Table(name="transferfahrten")
 */

class Transferfahrten
{
	/**
	 * @ORM\Id
	 * @ORM\GeneratedValue(strategy="AUTO")
	 * @ORM\Column(type="integer")
	 */
	private $id;


	/**
	 * Setting mapping manyToOne Fahrzeuge->Transferfahrten
	 *
	 * @Assert\NotBlank()
	 * @ORM\ManyToOne(targetEntity="FahrzeugdatenblattBundle\Entity\Fahrzeugdatenblatt", inversedBy="transferfahrten")
	 * @ORM\JoinColumn(nullable=true)
	 */

	private $fahrzeuge;

	/**
	 * @return mixed
	 */
	public function getFahrzeuge()
	{
		return $this->fahrzeuge;
	}

	/**
	 * @param mixed $fahrzeuge
	 */
	public function setFahrzeuge($fahrzeuge)
	{
		$this->fahrzeuge = $fahrzeuge;
	}



	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string")
	 */
	private $startDestination;

	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="string")
	 */
	private $finishDestination;

	/**
	 * @Assert\Type(type="integer")
	 * @ORM\Column(type="integer")
	 */
	private $duration;

	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="integer")
	 */
	private $distance;

	/**
	 * @return mixed
	 */
	public function getStartDestination()
	{
		return $this->startDestination;
	}

	/**
	 * @param mixed $startDestination
	 */
	public function setStartDestination($startDestination)
	{
		$this->startDestination = $startDestination;
	}

	/**
	 * @return mixed
	 */
	public function getFinishDestination()
	{
		return $this->finishDestination;
	}

	/**
	 * @param mixed $finishDestination
	 */
	public function setFinishDestination($finishDestination)
	{
		$this->finishDestination = $finishDestination;
	}

	/**
	 * @return mixed
	 */
	public function getDuration()
	{
		return $this->duration;
	}

	/**
	 * @param mixed $duration
	 */
	public function setDuration($duration)
	{
		$this->duration = $duration;
	}

	/**
	 * @return mixed
	 */
	public function getDistance()
	{
		return $this->distance;
	}

	/**
	 * @param mixed $distance
	 */
	public function setDistance($distance)
	{
		$this->distance = $distance;
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
	public function getCreatedAt()
	{
		return $this->createdAt;
	}

	/**
	 * @param mixed $createdAt
	 */
	public function setCreatedAt($createdAt)
	{
		$this->createdAt = $createdAt;
	}

	/**
	 * @ORM\Column(type="datetime", nullable=true)
	 */
	private $createdAt;

	/**
	 * @Assert\NotBlank()
	 * @ORM\Column(type="boolean")
	 */
	private $isPublished;

	/**
	 * @return mixed
	 */
	public function getisPublished()
	{
		return $this->isPublished;
	}

	/**
	 * @param mixed $isPublished
	 */
	public function setIsPublished($isPublished)
	{
		$this->isPublished = $isPublished;
	}



}