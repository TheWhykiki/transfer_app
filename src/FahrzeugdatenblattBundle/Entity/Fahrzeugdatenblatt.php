<?php

namespace FahrzeugdatenblattBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Fahrzeugdatenblatt
 *
 * @ORM\Table(name="fahrzeugdatenblatt")
 * @ORM\Entity(repositoryClass="FahrzeugdatenblattBundle\Repository\FahrzeugdatenblattRepository")
 */
class Fahrzeugdatenblatt
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
	 * @ORM\OneToMany(targetEntity="FahrzeugdatenblattBundle\Entity\Transferfahrten", mappedBy="fahrzeuge")
	 */
	private $transferfahrten;

	public function __construct()
	{
		$this->transferfahrten = new ArrayCollection();
	}

	/**
     * @var string
     *
     * @ORM\Column(name="fahrzeug_marke", type="string", length=255)
     */
    private $fahrzeugMarke;

    /**
     * @var string
     *
     * @ORM\Column(name="fahrzeug_modell", type="string", length=255)
     */
    private $fahrzeugModell;

    /**
     * @var string
     *
     * @ORM\Column(name="fahrzeug_kategorie", type="string", length=255)
     */
    private $fahrzeugKategorie;

    /**
     * @var int
     *
     * @ORM\Column(name="personen_max", type="integer", nullable=true)
     */
    private $personenMax;

    /**
     * @var int
     *
     * @ORM\Column(name="gepaeck_max", type="integer", nullable=true)
     */
    private $gepaeckMax;

    /**
     * @var int
     *
     * @ORM\Column(name="preis_km", type="integer", nullable=true)
     */
    private $preisKm;

    /**
     * @var int
     *
     * @ORM\Column(name="preis_stunde", type="integer", nullable=true)
     */
    private $preisStunde;

    /**
     * @var int
     *
     * @ORM\Column(name="preis_grund", type="integer", nullable=true)
     */
    private $preisGrund;

    /**
     * @var string
     *
     * @ORM\Column(name="bild_fahrzeug", type="string", length=255, nullable=true)
     */
    private $bildFahrzeug;

    /**
     * @var string
     *
     * @ORM\Column(name="zusatzinfos", type="text", nullable=true)
     */
    private $zusatzinfos;


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
     * Set fahrzeugMarke
     *
     * @param string $fahrzeugMarke
     *
     * @return Fahrzeugdatenblatt
     */
    public function setFahrzeugMarke($fahrzeugMarke)
    {
        $this->fahrzeugMarke = $fahrzeugMarke;

        return $this;
    }

    /**
     * Get fahrzeugMarke
     *
     * @return string
     */
    public function getFahrzeugMarke()
    {
        return $this->fahrzeugMarke;
    }

    /**
     * Set fahrzeugModell
     *
     * @param string $fahrzeugModell
     *
     * @return Fahrzeugdatenblatt
     */
    public function setFahrzeugModell($fahrzeugModell)
    {
        $this->fahrzeugModell = $fahrzeugModell;

        return $this;
    }

    /**
     * Get fahrzeugModell
     *
     * @return string
     */
    public function getFahrzeugModell()
    {
        return $this->fahrzeugModell;
    }

    /**
     * Set fahrzeugKategorie
     *
     * @param string $fahrzeugKategorie
     *
     * @return Fahrzeugdatenblatt
     */
    public function setFahrzeugKategorie($fahrzeugKategorie)
    {
        $this->fahrzeugKategorie = $fahrzeugKategorie;

        return $this;
    }

    /**
     * Get fahrzeugKategorie
     *
     * @return string
     */
    public function getFahrzeugKategorie()
    {
        return $this->fahrzeugKategorie;
    }

    /**
     * Set personenMax
     *
     * @param integer $personenMax
     *
     * @return Fahrzeugdatenblatt
     */
    public function setPersonenMax($personenMax)
    {
        $this->personenMax = $personenMax;

        return $this;
    }

    /**
     * Get personenMax
     *
     * @return int
     */
    public function getPersonenMax()
    {
        return $this->personenMax;
    }

    /**
     * Set gepaeckMax
     *
     * @param integer $gepaeckMax
     *
     * @return Fahrzeugdatenblatt
     */
    public function setGepaeckMax($gepaeckMax)
    {
        $this->gepaeckMax = $gepaeckMax;

        return $this;
    }

    /**
     * Get gepaeckMax
     *
     * @return int
     */
    public function getGepaeckMax()
    {
        return $this->gepaeckMax;
    }

    /**
     * Set preisKm
     *
     * @param integer $preisKm
     *
     * @return Fahrzeugdatenblatt
     */
    public function setPreisKm($preisKm)
    {
        $this->preisKm = $preisKm;

        return $this;
    }

    /**
     * Get preisKm
     *
     * @return int
     */
    public function getPreisKm()
    {
        return $this->preisKm;
    }

    /**
     * Set preisStunde
     *
     * @param integer $preisStunde
     *
     * @return Fahrzeugdatenblatt
     */
    public function setPreisStunde($preisStunde)
    {
        $this->preisStunde = $preisStunde;

        return $this;
    }

    /**
     * Get preisStunde
     *
     * @return int
     */
    public function getPreisStunde()
    {
        return $this->preisStunde;
    }

    /**
     * Set preisGrund
     *
     * @param integer $preisGrund
     *
     * @return Fahrzeugdatenblatt
     */
    public function setPreisGrund($preisGrund)
    {
        $this->preisGrund = $preisGrund;

        return $this;
    }

    /**
     * Get preisGrund
     *
     * @return int
     */
    public function getPreisGrund()
    {
        return $this->preisGrund;
    }

    /**
     * Set bildFahrzeug
     *
     * @param string $bildFahrzeug
     *
     * @return Fahrzeugdatenblatt
     */
    public function setBildFahrzeug($bildFahrzeug)
    {
        $this->bildFahrzeug = $bildFahrzeug;

        return $this;
    }

    /**
     * Get bildFahrzeug
     *
     * @return string
     */
    public function getBildFahrzeug()
    {
        return $this->bildFahrzeug;
    }

    /**
     * Set zusatzinfos
     *
     * @param string $zusatzinfos
     *
     * @return Fahrzeugdatenblatt
     */
    public function setZusatzinfos($zusatzinfos)
    {
        $this->zusatzinfos = $zusatzinfos;

        return $this;
    }

    /**
     * Get zusatzinfos
     *
     * @return string
     */
    public function getZusatzinfos()
    {
        return $this->zusatzinfos;
    }

	/**
	 * @return mixed
	 */
	public function getTransferfahrten()
	{
		return $this->transferfahrten;
	}



	/**
	 * Setting up string function for getting
	 * Fahrzeugdata
	 */

	public function __toString()
	{
		$fahrzeugMarke = $this->getFahrzeugMarke();
		$fahrzeugModell = $this->getFahrzeugModell();

		// Displayed name in Select Field in Transfer form

		return $fahrzeugMarke.'_'.$fahrzeugModell;
	}
}

