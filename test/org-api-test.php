<?php

require_once ("bread-basket.php");
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

class OrganizationApiTest {

	protected $guzzle = null;

	public final function setUp() {
		// visit ourselves to get the cookie
		$this->guzzle = $client = new \GuzzleHttp\Client(["cookies" => true]);

		$output = $this->guzzle->request("GET", 'https://bootcamp-coders.cnm.edu/');

		$cookies = $this->guzzle->getConfig()["cookies"];
		var_dump($cookies->getCookieByName("XSRF-TOKEN"));

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