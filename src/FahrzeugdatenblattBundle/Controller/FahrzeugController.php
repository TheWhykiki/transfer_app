<?php

namespace FahrzeugdatenblattBundle\Controller;


use FahrzeugdatenblattBundle\Entity\Transferfahrten;
use FahrzeugdatenblattBundle\Form\FahrzeugdatenForm;
use FahrzeugdatenblattBundle\Form\TransferfahrtenForm;
use FahrzeugdatenblattBundle\Testfunctions\Testfunction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FahrzeugdatenblattBundle\Entity\Fahrzeugdatenblatt;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class FahrzeugController extends Controller
{
	/************************************************************************************************************************
	 *
	 * Neues Auto erstellen
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/neu_auto", name="neues_auto")
	 */
	public function autoErstellenAction(Request $request)
	{
		$fahrzeug = new Fahrzeugdatenblatt();

		$form = $this->createForm(FahrzeugdatenForm::class);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			$transferFormData = $form->getData();
			$em =   $this->getDoctrine()->getManager();
			$em->persist($transferFormData);
			$em->flush();

			$this->addFlash('success', 'Auto erstellt!');
			return $this->redirectToRoute('list_all_cars');
		}

		return $this->render('admin_templates/auto_neu.html.twig',[
			'autoForm' => $form->createView()
		]);
	}

	/************************************************************************************************************************
	 *
	 * Auto Details
	 *
	 ***********************************************************************************************************************/
	/**
	 * @Route("/car_details/{id}", name="car_detail_view")
	 */

	public function listFahrtenCarAction(Fahrzeugdatenblatt $fahrzeugdatenblatt){
		$fahrten = $fahrzeugdatenblatt->getTransferfahrten();
		$automarke = $fahrzeugdatenblatt->getFahrzeugMarke();

		return $this->render('admin_templates/car_detail_view.html.twig',[
			'transferfahrten' => $fahrten,
			'fahrzeugmarke' => $automarke
		]);
	}

	/************************************************************************************************************************
	 *
	 * Alle Autos anzeigen
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/list_cars", name="list_all_cars")
	 */

	public function listAllCars(){

		$em = $this->getDoctrine()->getManager();
		$cars = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
					->findAll();

		return $this->render('admin_templates/car_list_view.html.twig',[
			'alleAutos' => $cars,
		]);
	}



	/************************************************************************************************************************
	 *
	 * Fahrten Testcontroller1
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/fahrten_testcontroller", name="fahrten_testcontroller")
	 */
	public function fahrtenTestAction(Request $request)
	{

		// Count all cars
		$em = $this->getDoctrine()->getManager();



		$fahrten = $em->getRepository('FahrzeugdatenblattBundle:Transferfahrten')
						->getAllCarID();

		$cars = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
			->anfrageNeuAllCars();

		dump($fahrten);die;
		return $this->render('admin_templates/ausgabe_alle_fahrten_Alter.html.twig',[
			'alleAutos' => $cars
		]);
	}

	/************************************************************************************************************************
	 *
	 * Fahrten Testcontroller2
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/fahrten_testcontroller2", name="fahrten_testcontroller2")
	 */
	public function fahrtenTest2Action(Request $request)
	{
		$em = $this->getDoctrine()->getManager();


		// Find all cars from database

		/** @var  Fahrzeugdatenblatt $getAllCars */
		$getAllCars = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
						->findAll();

		// Set array for all Car IDs

		$allCarIDs = [];
		foreach ($getAllCars as $car){
			/** @var  Fahrzeugdatenblatt $car */
			$allCarIDs[] = $car->getID();
		}

		// Find all transfers which are blocked in the desired transfertime

		$startzeit = new \DateTime('2017-11-07 07:00');
		$endzeit = new \DateTime('2017-11-07 17:00');

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
			if (in_array($carID, $allBlockedCarIDs)) {
				 $state = true;
			};

			// Set id's and state

			$allCarsAndState[] = [
				'id' => $carID,
				'state' => $state
			];
		}

		dump($allCarsAndState);die;
		return $this->render('admin_templates/ausgabe_alle_fahrten_Alter.html.twig',[
			'alleAutos' => $cars
		]);
	}

}
