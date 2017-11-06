<?php

namespace FahrzeugdatenblattBundle\Controller;


use FahrzeugdatenblattBundle\Form\FahrzeugdatenForm;
use FahrzeugdatenblattBundle\Form\TransferfahrtenForm;
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
		$form = $this->createForm(FahrzeugdatenForm::class);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			dump($form->getData()); die;
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

	/**
	 * @Route("/spielereikiki/{namekiki}", name="spielereiKiki")
	 */
	public function spielereikikiAction($namekiki){

		$helptext = [
			'Hallo1',
			'Hallo2',
			'Hallo3'
		];
		return $this->render('fahrzeugdatenblatt_frontend/ausgabe2.html.twig', [
			'name' => $namekiki,
			'help' => $helptext
		]);
	}

	/************************************************************************************************************************
	 *
	 * Fahrten Testcontroller
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/fahrten_testcontroller", name="fahrten_testcontroller")
	 */
	public function fahrtenTestAction(Request $request)
	{

		// Count all cars
		$em = $this->getDoctrine()->getManager();
		$cars = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
			->anfrageFilterCars();


		return $this->render('admin_templates/ausgabe_alle_fahrten_Alter.html.twig',[
			'alleAutos' => $cars
		]);
	}

}
