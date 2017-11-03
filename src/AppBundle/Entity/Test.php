<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Test
 *
 * @ORM\Table(name="test")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\TestRepository")
 */
class Test
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
     * @ORM\Column(name="Datum1", type="datetime")
     */
    private $datum1;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="Time1", type="datetime")
     */
    private $time1;


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
     * @return Test
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
     * Set datum1
     *
     * @param \DateTime $datum1
     *
     * @return Test
     */
    public function setDatum1($datum1)
    {
        $this->datum1 = $datum1;

        return $this;
    }

    /**
     * Get datum1
     *
     * @return \DateTime
     */
    public function getDatum1()
    {
        return $this->datum1;
    }

    /**
     * Set time1
     *
     * @param \DateTime $time1
     *
     * @return Test
     */
    public function setTime1($time1)
    {
        $this->time1 = $time1;

        return $this;
    }

    /**
     * Get time1
     *
     * @return \DateTime
     */
    public function getTime1()
    {
        return $this->time1;
    }
}

