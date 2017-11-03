<?php

namespace FahrzeugdatenblattBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use FahrzeugdatenblattBundle\Entity\Fahrzeugdatenblatt;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class DefaultSpielereiController extends Controller
{
	/**
	 * @Route("/api_getter/{linker}", name="apiGetter")
	 * @Method("GET")
	 */
	public function showJSONAction($linker){
		$derLink = $linker;
		$testArray = [
			'wert0' => $derLink,
			'wert1' => 'KIki1',
			'wert2' => 'KIki2',
			'wert3' => 'KIki3',
		];

		$data = [
			'daten' => $testArray
		];

		return new JsonResponse($data);
	}

}
