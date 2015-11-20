<?php

require_once ("bread-basket.php");
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

class OrganizationApiTest {

	protected $guzzle = null;

	public final function setUp() {
		// visit ourselves to get the cookie
		//for now, going to assume that the cookie is automagically handled
		//confirmed this is getting some form of cookie: not sure if it's the right one
		$this->guzzle = $client = new \GuzzleHttp\Client(["cookies" => true]);

//		$output = $this->guzzle->request("GET", 'https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization');
		$output = $this->guzzle->request("GET", 'https://bootcamp-coders.cnm.edu/');
		//var_dump($output); //getting the reply

		$testingthings = $this->guzzle->getConfig();
		var_dump($testingthings['cookies']); //getting the cookies

		//var_dump($this->guzzle); //getting the entire object

	}
	public function testValidGet() {

	}
	public function testInvalidGet() {

	}
	public function testValidPut() {

	}
	public function testInvalidPut() {

	}
	public function testValidPost() {

	}
	public function testInvalidPost() {

	}
	public function testValidDelete() {

	}
	public function testInvalidDelete() {

	}


}

$test = new OrganizationApiTest();
$test->setUp();