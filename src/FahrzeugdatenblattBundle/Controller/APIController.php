<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 05.11.2017
 * Time: 17:18
 */

namespace FahrzeugdatenblattBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FahrzeugdatenblattBundle\Entity\Transferfahrten;
use FahrzeugdatenblattBundle\Form\TransferfahrtenForm;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class APIController extends Controller
{

	/************************************************************************************************************************
	 *
	 * API Endpoint all Transfers
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/json_cars")
	 * @Method("GET")
	 */
	public function getJSONTransfersAction(){

		// Search database for all transfers

		$em = $this->getDoctrine()->getManager();
		$transfers = $em->getRepository('FahrzeugdatenblattBundle:Transferfahrten')
			->findAll();

		// Generate JSON Structure
		$jsonData = [];

		foreach($transfers as $transfer){
			$date = $transfer->getCreatedAt();
			$start = $transfer->getStartDestination();
			$ziel = $transfer->getFinishDestination();
			$fahrzeugMarke = $transfer->getFahrzeuge()->getFahrzeugMarke();
			$fahrzeugID = $transfer->getFahrzeuge()->getID();
			$jsonData[] = [
				'start' => $start,
				'ziel' => $ziel,
				'fahrzeugMarke' => $fahrzeugMarke,
				'fahrzeugID' => $fahrzeugID,
				'datum' => $date
			];
		}

		return New Response(json_encode($jsonData));
	}
}