<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 05.11.2017
 * Time: 17:18
 */

namespace FahrzeugdatenblattBundle\Controller;


use FahrzeugdatenblattBundle\Entity\Fahrzeugdatenblatt;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use FahrzeugdatenblattBundle\Entity\Transferfahrten;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class APIController extends Controller
{

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


		$datum = $request->request->get('startTime');
		// Search database for all transfers

		$em = $this->getDoctrine()->getManager();
		$autos = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
			->anfrageFilterCars($datum);

		// Set new transfer

		$startDestination = $request->request->get('startDestination');
		$finishDestination = $request->request->get('finishDestination');
		$customerStartTime = new \DateTime($request->request->get('startTime'));
		$customerEndTime = $request->request->get('endTime');
		$distance = $request->request->get('distance');
		$duration = $request->request->get('duration');

		$neueFahrt = new Transferfahrten();
		$neueFahrt->setStartTime($customerStartTime);
		//$neueFahrt->setEndTime($customerEndTime);
		$neueFahrt->setStartDestination($startDestination);
		$neueFahrt->setFinishDestination($finishDestination);
		$neueFahrt->setDuration($duration);
		$neueFahrt->setDistance($distance);
		$neueFahrt->setIsPublished(1);

		$em->persist($neueFahrt);
		$em->flush();
		$insertedTransferID = $neueFahrt->getId();

		// Generate JSON Structure
		$jsonData = [];

		/** @var  Fahrzeugdatenblatt $auto */

		foreach($autos as $auto){
			$transfersComplete = $auto->getTransferfahrten();
			$transfersArray = [];

			/** @var  Transferfahrten $transfer */

			foreach($transfersComplete as $transfer){
				$transfersArray[] = $transfer->getStartDestination();
			}
			$jsonData[] = [
				'id' => $insertedTransferID,
				'transfers' => $transfersArray

			];
		}
		//dump($jsonData);die;

		return New JsonResponse($jsonData);
		//return New Response(json_encode($jsonData));
	}

	/**********************************************************************************************************************
	 *
	 *  API Endpoint Cars And States OK  *************************************************************************************
	 *
	 *********************************************************************************************************************/

	/**
	 * @Route("/json_cars_filtered_testerei")
	 * @Method("POST")
	 */

	public function getJSONCarsAndStateFilteredAction(Request $request){

		$startzeit = $request->request->get('startTime');
		$endzeit = $request->request->get('endTime');

		$em = $this->getDoctrine()->getManager();

		// Set new transfer

		$startDestination = $request->request->get('startDestination');
		$finishDestination = $request->request->get('finishDestination');
		$customerStartTime = new \DateTime($request->request->get('startTime'));
		$customerEndTime = $request->request->get('endTime');
		$distance = $request->request->get('distance');
		$duration = $request->request->get('duration');

		$neueFahrt = new Transferfahrten();
		$neueFahrt->setStartTime($customerStartTime);
		//$neueFahrt->setEndTime($customerEndTime);
		$neueFahrt->setStartDestination($startDestination);
		$neueFahrt->setFinishDestination($finishDestination);
		$neueFahrt->setDuration($duration);
		$neueFahrt->setDistance($distance);
		$neueFahrt->setIsPublished(1);

		$em->persist($neueFahrt);
		$em->flush();
		$insertedTransferID = $neueFahrt->getId();

		// Find all cars from database

		/** @var  Fahrzeugdatenblatt $getAllCars */
		$getAllCars = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
			->findAll();

		// Set array for all Car IDs

		$allCarIDs = [];
		foreach ($getAllCars as $car){
			/** @var  Fahrzeugdatenblatt $car */
			$allCarIDs[] = $car->getID();
			$allCarNames[] = $car->getFahrzeugMarke();
		}

		// Find all transfers which are blocked in the desired transfertime

		/** @var  Transferfahrten $getBlockedTransfers */
		$getBlockedTransfers = $em->getRepository('FahrzeugdatenblattBundle:Transferfahrten')
			->getBlockedTransfers($startzeit, $endzeit);


		// Set array for all blocked Car IDs

		$allBlockedCarIDs = [];

		foreach($getBlockedTransfers as $transfer){
			/** @var  Transferfahrten $transfer */
			$allBlockedCarIDs [] = $transfer->getFahrzeuge()->getID();
		}

		// Set array for all Cars and State

		$allCarsAndState = [];
		foreach($getAllCars as $car){

			// Set default state to false
			$state = false;
			/** @var  Fahrzeugdatenblatt $car */

			// Get all car ids and compare if they
			// are in $allBlockedCarIDs
			// if they are in array set state to true

			$carID = $car->getId();
			$carMarke = $car->getFahrzeugMarke();
			$carModell = $car->getFahrzeugModell();
			$carKategorie = $car->getFahrzeugKategorie();
			$carBild = $car->getBildFahrzeug();
			$carGepaeckMax = $car->getGepaeckMax();
			$carPersonenMax = $car->getPersonenMax();
			$carStunde = $car->getPreisStunde();
			$carGrund = $car->getPreisGrund();
			$carKM = $car->getPreisKm();

			if (in_array($carID, $allBlockedCarIDs)) {
				$state = true;
			};

			// Set id's and state

			$allCarsAndState[] = [
				'currentTransferID' => $insertedTransferID,
				'id' => $carID,
				'marke' => $carMarke,
				'modell' => $carModell,
				'bild' => $carBild,
				'kategorie' => $carKategorie,
				'preisGrund' => $carGrund,
				'preisStunde' => $carStunde,
				'gepaeckMax' => $carGepaeckMax,
				'personenMax' => $carPersonenMax,
				'preisKM' => $carKM,
				'state' => $state
			];
		}

		//dump($allCarsAndState);die;
		return New JsonResponse($allCarsAndState);

	}
}