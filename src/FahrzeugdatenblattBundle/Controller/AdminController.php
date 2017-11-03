<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 15.10.2017
 * Time: 12:58
 */

namespace FahrzeugdatenblattBundle\Controller;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AdminController as BaseAdminController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminController extends BaseAdminController
{

	public function testkikiAction(){
		// redirect to the 'list' view of the given entity
		$ergebnis = "Koko";
		$katze = $this->ausgabeKiki();
		return $this->render('fahrzeugdatenblatt_frontend/ausgabe.html.twig', [
			'katze' => $katze,
			'ergebnis' => $ergebnis,
			'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
		]);
	}


	public function ausgabeKiki(){
	$tester = "Wlli";
	return $tester;
	}



}


