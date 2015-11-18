<?php

require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

class OrganizationApiTest {

	protected $guzzle = null;

	public function setUp() {
		// visit ourselves to get the cookie
		$this->guzzle = $client = new \GuzzleHttp\Client(["cookies" => true]);
		$this->guzzle->request("GET, "https://bootcamp-coders.cnm.edu/");

	}

	public function testValidGet() {

	}
}