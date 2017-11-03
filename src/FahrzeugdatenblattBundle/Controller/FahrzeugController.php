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


    /**
     * Route zum Spielen für den Kiki
     *
     * @Route("/tester", name="testkiki")
     *
     */
    public function indexAction(Request $request)
    {
    	//var_dump($name);
	    //return $this->render('FahrzeugdatenblattBundle:Default:index.html.twig');

		$ergebnis = $this->getDoctrine()->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')->findAll();
		//var_dump$ergebnis);
	    //$marke = $_GET['marke'];
		if(!empty($marke)){
			echo $marke;
		}
		else{
			echo "Willi22";
		}

	    return $this->render('fahrzeugdatenblatt_frontend/ausgabe.html.twig', [
		    'ergebnis' => $ergebnis,
		    'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
	    ]);
    }


	/**
	 * Route zum Erstellen neuer Autos in der Fahrzeugliste
	 * @Route("/neu_auto", name="neues_auto")
	 */
	public function autoErstellenAction(Request $request)
	{
		$form = $this->createForm(FahrzeugdatenForm::class);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			dump($form->getData()); die;
		}

		return $this->render('fahrzeugdatenblatt_frontend/auto_neu.html.twig',[
			'autoForm' => $form->createView()
		]);
	}

	/**
	 * @Route("/list_cars", name="list_all_cars")
	 */

	public function listAllCars(){

		$em = $this->getDoctrine()->getManager();
		$cars = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
					->findAll();
		dump($cars);die;
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

}
