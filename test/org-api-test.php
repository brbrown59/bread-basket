<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

class OrganizationApiTest {

	protected $guzzle = null;

	public function setUp() {
		// visit ourselves to get the cookie
		//for now, going to assume that the cookie is automagically handled
		//confirmed this is getting some form of cookie: not sure if it's the right one
		$this->guzzle = $client = new \GuzzleHttp\Client(["cookies" => true]);
		//this is only getting to the bootcamp coders home page???
		//but, it 404s if you change the deeper directories
		$output = $this->guzzle->request("GET", 'https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization');
		var_dump($output);
	}

}

$test = new OrganizationApiTest();
$test->setUp();