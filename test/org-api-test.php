<?php

require_once ("bread-basket.php");
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

class OrganizationApiTest {

	protected $guzzle = null;

	public final function setUp() {
		//create a new organization for the test volunteers to belong
		$organization = new Organization(null, "123 Easy Street", '', "Albuquerque", "Feeding people since 1987", "9 - 5", "Feed the People", "505-765-4321", "NM", "R", "87801");

		//create a new volunteer to use as an admin for the tests
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password4321", $salt, 262144, 128);
		$admin = new Volunteer(null, $organization->getOrgId(), "fakeemail@fake.com", null, "John", $hash, true, "Doe", "505-123-4567", $salt);

		//create a non-admin volunteer for the tests
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password4321", $salt, 262144, 128);
		$volunteer = new Volunteer(null, $organization->getOrgId(), "notanemail@fake.com", null, "Jane", $hash, true, "Doe", "505-555-5555", $salt);

		//sign-in the volunteers, or just make dummy sessions?

		// visit ourselves to get the cookie
		$this->guzzle = $client = new \GuzzleHttp\Client(["cookies" => true]);

		$output = $this->guzzle->request("GET", 'https://bootcamp-coders.cnm.edu/');

		$cookies = $this->guzzle->getConfig()["cookies"];
		var_dump($cookies->getCookieByName("XSRF-TOKEN"));

	}

	//test getting a valid entry and making sure it
	public function testValidGet() {
		//test getting by parameter x

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