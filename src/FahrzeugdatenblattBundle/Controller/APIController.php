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
use FahrzeugdatenblattBundle\Form\AnfrageForm;
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
	 * @Method("POST")
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


 /************************************************************************************************************************
 *
 * API Endpoint Filtered Transfer Test
 *
 ***********************************************************************************************************************/

	/**
	 * @Route("/json_transfers_filtered")
	 * @Method("POST")
	 */
	public function getJSONTransfersFilteredAction(){

		$name = $_POST['name'];
		//dump($name);die;
		// Search database for all transfers

		$em = $this->getDoctrine()->getManager();
		$transfers = $em->getRepository('FahrzeugdatenblattBundle:Transferfahrten')
			->findBy(['startDestination' => $name]);

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

	/************************************************************************************************************************
	 *
	 * API Endpoint Filtered Transfer Test GET
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/json_transfers_getfiltered")
	 * @Method("GET")
	 */
	public function getJSONTransfersFilteredGetAction(){

		//$name = $_POST['name'];
		//dump($name);die;
		// Search database for all transfers

		$em = $this->getDoctrine()->getManager();
		$transfers = $em->getRepository('FahrzeugdatenblattBundle:Transferfahrten')
			->findBy(['startDestination' => 'Moers']);

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

	/************************************************************************************************************************
	 *
	 * API Endpoint Filtered Auros Test
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/json_cars_filtered")
	 * @Method("POST")
	 */
	public function getJSONCarsFilteredAction(Request $request){


		$datum = $request->request->get('name');
		// Search database for all transfers

		$em = $this->getDoctrine()->getManager();
		$autos = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
			->anfrageFilterCars($datum);

		// Generate JSON Structure
		$jsonData = [];

		foreach($autos as $auto){
			$marke = $auto->getFahrzeugMarke();
			$modell = $auto->getFahrzeugModell();
			//$transferDatum = $auto->getTransferfahrten()->getCreatedAt();
			$jsonData[] = [
				'marke' => $marke,
				'modell' => $modell,

			];
		}
		//dump($jsonData);die;
		return New Response(json_encode($jsonData));
	}
}