<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 15.10.2017
 * Time: 12:58
 */

namespace FahrzeugdatenblattBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class AdminController extends Controller
{

	/**
	 * @Route("/administrator", name="administrator")
	 */
	public function showAdminBackendAction(){
		return $this->render('admin_templates/base.html.twig');
	}

}


