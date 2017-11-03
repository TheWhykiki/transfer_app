<?php
/**
 * Created by PhpStorm.
 * User: Whykiki2013
 * Date: 01.11.2017
 * Time: 22:17
 */

namespace FahrzeugdatenblattBundle\Testfunctions;


class Testfunction
{

	private $parser;

	public function __construct($parser)
	{
		$this->parser = $parser;
	}

	public function testkikiFunction(){

		return $this->parser;
	}
}