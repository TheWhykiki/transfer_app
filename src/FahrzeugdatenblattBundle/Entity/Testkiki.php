<?php

namespace FahrzeugdatenblattBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Testkiki
 *
 * @ORM\Table(name="testkiki")
 * @ORM\Entity(repositoryClass="FahrzeugdatenblattBundle\Repository\TestkikiRepository")
 */
class Testkiki
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="Testfeld1", type="string", length=255)
     */
    private $testfeld1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date1", type="datetime")
     */
    private $date1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date2", type="datetime")
     */
    private $date2;

    /**
     * @var string
     *
     * @ORM\Column(name="carID", type="string", length=255)
     */
    private $carID;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set testfeld1
     *
     * @param string $testfeld1
     *
     * @return Testkiki
     */
    public function setTestfeld1($testfeld1)
    {
        $this->testfeld1 = $testfeld1;

        return $this;
    }

    /**
     * Get testfeld1
     *
     * @return string
     */
    public function getTestfeld1()
    {
        return $this->testfeld1;
    }

    /**
     * Set date1
     *
     * @param \DateTime $date1
     *
     * @return Testkiki
     */
    public function setDate1($date1)
    {
        $this->date1 = $date1;

        return $this;
    }

    /**
     * Get date1
     *
     * @return \DateTime
     */
    public function getDate1()
    {
        return $this->date1;
    }

    /**
     * Set date2
     *
     * @param \DateTime $date2
     *
     * @return Testkiki
     */
    public function setDate2($date2)
    {
        $this->date2 = $date2;

        return $this;
    }

    /**
     * Get date2
     *
     * @return \DateTime
     */
    public function getDate2()
    {
        return $this->date2;
    }

    /**
     * Set carID
     *
     * @param string $carID
     *
     * @return Testkiki
     */
    public function setCarID($carID)
    {
        $this->carID = $carID;

        return $this;
    }

    /**
     * Get carID
     *
     * @return string
     */
    public function getCarID()
    {
        return $this->carID;
    }
}

