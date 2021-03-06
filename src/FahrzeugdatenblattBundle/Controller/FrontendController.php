<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 05.11.2017
 * Time: 18:45
 */

namespace FahrzeugdatenblattBundle\Controller;


use FahrzeugdatenblattBundle\Form\AnfrageForm;
use FahrzeugdatenblattBundle\Testfunctions\Testfunction;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FrontendController extends Controller
{

	/**
	 * @Route("/", name="homepage")
	 */
	public function showFrontendStartpageAction(Request $request){

		$form = $this->createForm(AnfrageForm::class);
		$form->handleRequest($request);


		return $this->render('frontend_templates/base.html.twig',[
			'anfrageForm' => $form->createView(),
		]);
	}

	/**
	 * @Route("/spielerei_front", name="spielereiFront")
	 */
	public function spielereiFrontAction(Testfunction $testfunction){

		$testVar = $testfunction->testkikiFunction();
		dump($testVar);die;
		return $this->render('frontend_templates/base.html.twig',[
			'tester' => $testfunction->testkikiFunction()
		]);
	}
}