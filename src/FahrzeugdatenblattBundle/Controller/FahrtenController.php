<?php

namespace FahrzeugdatenblattBundle\Controller;


use FahrzeugdatenblattBundle\Entity\Fahrzeugdatenblatt;
use FahrzeugdatenblattBundle\Entity\Transferfahrten;
use FahrzeugdatenblattBundle\Form\TransferfahrtenForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FahrtenController extends Controller
{

	/************************************************************************************************************************
	 *
	 * Testclass generating transfers
	 *
	 ***********************************************************************************************************************/

	/**
	 *
	 * @Route("/neue_fahrt_generator", name="neue_fahrt_generator")
	 */
	public function fahrtGenerierenAction(Request $request)
	{
		$fahrzeugName = "Schowalter LLC";
		$em = $this->getDoctrine()->getManager();
		$cars = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
			->findByMarke($fahrzeugName);

		$neueFahrt = new Transferfahrten();
		$neueFahrt->setStartDestination('Moers');
		$neueFahrt->setFinishDestination('Koeln');
		$neueFahrt->setDuration(12345);
		$neueFahrt->setDistance(12345);
		$neueFahrt->setFahrzeuge($cars);

		$em->persist($neueFahrt);
		$em->flush();

		return new Response('Fahrt erstellt');
	}

	/************************************************************************************************************************
	 *
	 * Neue Fahrt erstellen with Form
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/neue_fahrt", name="neue_fahrt")
	 */
	public function fahrtErstellenAction(Request $request)
	{

		// Create form based on Form->TransferfahrtenForm
		// form data is binded to TRansferfahrten Entity
		// see TransferfahrtenForm.php line25

		$form = $this->createForm(TransferfahrtenForm::class);

		// Handle request of the data
		// works only on post

		$form->handleRequest($request);


		// Action when form is submittend and valid

		if($form->isSubmitted() && $form->isValid()){
			$transferFormData = $form->getData();
			$em =   $this->getDoctrine()->getManager();
					$em->persist($transferFormData);
					$em->flush();

			$this->addFlash('success', 'Transferfahrt erstellt!');
			return $this->redirectToRoute('alle_fahrten_uncached');
		}

		// Normal action when calling the form, without post -> get

		return $this->render('admin_templates/transfer_neu.html.twig',[
			'transferForm' => $form->createView()
		]);
	}

	/************************************************************************************************************************
	 *
	 * Fahrt editieren
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/fahrt_editieren/{id}/editieren", name="fahrt_editieren")
	 */
	public function editTransferAction(Request $request, Transferfahrten $transferfahrten)
	{

		$form = $this->createForm(TransferfahrtenForm::class, $transferfahrten);
		$form->handleRequest($request);

		// Action when form is submittend and valid

		if($form->isSubmitted() && $form->isValid()){
			$transferFormData = $form->getData();
			$em =   $this->getDoctrine()->getManager();
			$em->persist($transferFormData);
			$em->flush();

			$this->addFlash('success', 'Transferfahrt editiert!');
			return $this->redirectToRoute('alle_fahrten_uncached');
		}

		// Normal action when calling the form, without post -> get

		return $this->render('admin_templates/transfer_editieren.html.twig',[
			'transferForm' => $form->createView()
		]);
	}

	/************************************************************************************************************************
	 *
	 * Alle Fahrten cached
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/alle_fahrten_cached", name="alle_fahrten_cached")
	 */
	public function fahrtenAnzeigenCachedAction(Request $request)
	{

		// Getting page, limit, sortKey, sortDirection for having separate keys
		// for caching

		$page = $request->query->getInt('page',1);
		$limit =  $request->query->getInt('limit',20);
		$sortKey = $request->query->get('sort');
		$direction = $request->query->get('direction');
		//dump($sort);die;

		// Set unique cacheKey based on page/limit

		$cacheKey = 'transfersCache-' . $page . '-' . $limit.'__'.$sortKey.'_'.$direction;

		// Get doctrine_cache

		$cache = $this->get('doctrine_cache.providers.my_markdown_cache');
		$cache->setNamespace('meinTollerCache');

		// Fetch paginated from cache
		$paginatedTransfers = $cache->fetch($cacheKey);

		// If paginatedTransfer is false
		// write paginatedTransfers with unique key in cache
		if (false === $paginatedTransfers) {

			// Use doctrine and query for pagination
			// the query for pagination and not the result:
			// so only the needed posts are queried

			$em = $this->getDoctrine()->getManager();
			$dql = "SELECT tf from FahrzeugdatenblattBundle:Transferfahrten tf";
			$query = $em->createQuery($dql);

			/**
			 * @var $paginator \Knp\Component\Pager\Paginator
			 */
			$paginator  = $this->get('knp_paginator');
			$paginatedTransfers = $paginator->paginate(
				$query,
				$page,
				$limit
			);
			$cache->save($cacheKey, $paginatedTransfers, 3600);
		}

		return $this->render('admin_templates/ausgabe_alle_fahrten.html.twig',[
			'transferfahrten' => $paginatedTransfers
		]);
	}

	/************************************************************************************************************************
	 *
	 * Alle Fahrten uncached
	 *
	 ***********************************************************************************************************************/

	/**
	 * @Route("/alle_fahrten_uncached", name="alle_fahrten_uncached")
	 */
	public function fahrtenAnzeigenUncachedAction(Request $request)
	{

		// Count all cars

		$em = $this->getDoctrine()->getManager();
		$cars = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
			->countAllCars();

		// Count all transfers

		$em = $this->getDoctrine()->getManager();
		$allTransfers = $em->getRepository('FahrzeugdatenblattBundle:Transferfahrten')
			->countAllTransfers();

		// Count transfers this month

		$em = $this->getDoctrine()->getManager();
		$allTransfersThisMonth = $em->getRepository('FahrzeugdatenblattBundle:Transferfahrten')
			->countAllTransfersThisMonth();
		//dump($allTransfersThisMonth); die;

		//* $testkiki */$testkiki = new Testfunction(
		//	$this->get('templating')->render('fahrzeugdatenblatt_frontend/eingabe.html.twig')
		//);

		$page = $request->query->getInt('page',1);
		$limit =  $request->query->getInt('limit',20);

		// Use doctrine and query for pagination
		// the query for pagination and not the result:
		// so only the needed posts are queried

		$em = $this->getDoctrine()->getManager();
		$dql = "SELECT tf from FahrzeugdatenblattBundle:Transferfahrten tf JOIN tf.fahrzeuge car";
		$query = $em->createQuery($dql);

		/**
		 * @var $paginator \Knp\Component\Pager\Paginator
		 */
		$paginator  = $this->get('knp_paginator');
		$paginatedTransfers = $paginator->paginate(
			$query,
			$page,
			$limit
		);

		dump($paginatedTransfers);die;

		return $this->render('admin_templates/ausgabe_alle_fahrten.html.twig',[
			'transferfahrten' => $paginatedTransfers,
			'alleAutos' => $cars,
			'alleTransfers' => $allTransfers,
			'alleTransfersDiesenMonat' => $allTransfersThisMonth
		]);
	}


}
