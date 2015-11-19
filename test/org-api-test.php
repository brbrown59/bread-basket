<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

class OrganizationApiTest {

	protected $guzzle = null;

	public function setUp() {
		// visit ourselves to get the cookie
		//for now, going to assume that the cookie is automagically handled
		$this->guzzle = $client = new \GuzzleHttp\Client(["cookies" => true]);
		$this->guzzle->request("GET", "https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization");


	}

}

$test = new OrganizationApiTest();
$test->setUp();