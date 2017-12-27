<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 15.10.2017
 * Time: 12:58
 */

namespace FahrzeugdatenblattBundle\Controller;
use FahrzeugdatenblattBundle\Form\VendorInformationsForm;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class AdminController extends Controller
{

	/**
	 * @Route("/administrator", name="administrator")
	 */
	public function showAdminBackendAction(Request $request){

		$username = $this->getUser();
		//dump($username);die;
		//dump($username);die;
		return $this->render('admin_templates/base.html.twig',[
			'benutzer' => $username,
		]);
	}

	/**
	 * @Route("/administrator/vendor_informations", name="vendor_informations")
	 */
	public function createVendorInformations(Request $request)
	{

		$form = $this->createForm(VendorInformationsForm::class);

		// Handle request of the data
		// works only on post

		$form->handleRequest($request);


		// Action when form is submittend and valid

		if($form->isSubmitted() && $form->isValid()){
			$transferFormData = $form->getData();
			$em =   $this->getDoctrine()->getManager();
			$em->persist($transferFormData);
			$em->flush();

			$this->addFlash('success', 'Verkäuferdaten gespeichert!');
			return $this->redirectToRoute('administrator');
		}

		// Normal action when calling the form, without post -> get

		return $this->render('admin_templates/transfer_neu.html.twig',[
			'vendorForm' => $form->createView()
		]);
	}

}


