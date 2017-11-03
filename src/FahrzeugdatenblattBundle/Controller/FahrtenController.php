<?php

namespace FahrzeugdatenblattBundle\Controller;


use FahrzeugdatenblattBundle\Entity\Fahrzeugdatenblatt;
use FahrzeugdatenblattBundle\Entity\Transferfahrten;
use FahrzeugdatenblattBundle\Form\TransferfahrtenForm;
use FahrzeugdatenblattBundle\Repository\FahrzeugdatenblattRepository;
use FahrzeugdatenblattBundle\Testfunctions\Testfunction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;

class FahrtenController extends Controller
{

	/**
	 * Testfunction for manually generating transfers
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

	/**
	 * @Route("/neue_fahrt", name="neue_fahrt")
	 */
	public function fahrtErstellenAction(Request $request)
	{
		$form = $this->createForm(TransferfahrtenForm::class);
		$form->handleRequest($request);

		if($form->isSubmitted() && $form->isValid()){
			dump($form->getData()); die;
		}

		return $this->render('fahrzeugdatenblatt_frontend/transfer_neu.html.twig',[
			'transferForm' => $form->createView()
		]);
	}

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

		return $this->render('fahrzeugdatenblatt_frontend/ausgabe_alle_fahrten.html.twig',[
			'transferfahrten' => $paginatedTransfers
		]);
	}



	/**
	 * @Route("/alle_fahrten_uncached", name="alle_fahrten_uncached")
	 */
	public function fahrtenAnzeigenUncachedAction(Request $request)
	{
		$em = $this->getDoctrine()->getManager();
		$cars = $em->getRepository('FahrzeugdatenblattBundle:Fahrzeugdatenblatt')
			->countAllCars();

		//* $testkiki */$testkiki = new Testfunction(
		//	$this->get('templating')->render('fahrzeugdatenblatt_frontend/eingabe.html.twig')
		//);

		$page = $request->query->getInt('page',1);
		$limit =  $request->query->getInt('limit',20);

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

		//dump($paginatedTransfers);die;

		return $this->render('fahrzeugdatenblatt_frontend/ausgabe_alle_fahrten.html.twig',[
			'transferfahrten' => $paginatedTransfers,
			'alleAutos' => $cars
		]);
	}
}
