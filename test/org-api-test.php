<?php

require_once ("bread-basket.php");
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

class OrganizationApiTest extends BreadBasketTest {



	protected $guzzle = null;

	protected $token = null;
	/**
	 * @var volunteer object
	 */
	protected $admin = null;
	/**
	 * @var volunteer object
	 */
	protected $volunteer = null;

	/**
	 * set up for dependent objects before running each test
	 */
	public final function setUp() {
		//run default set-up method
		parent::setUp();

		//create a new organization for the test volunteers to belong
		$organization = new Organization(null, "123 Easy Street", '', "Albuquerque", "Feeding people since 1987", "9 - 5", "Feed the People", "505-765-4321", "NM", "R", "87801");
		$organization->insert($this->getPDO());

		//create a new volunteer to use as an admin for the tests
		//don't need to insert them into the database: just need their info to create sessions
		//for testing purposes, allow them to create organizations they're not associated with
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password4321", $salt, 262144, 128);
		$this->admin = new Volunteer(null, $organization->getOrgId(), "fakeemail@fake.com", null, "John", $hash, true, "Doe", "505-123-4567", $salt);

		//create a non-admin volunteer for the tests
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password4321", $salt, 262144, 128);
		$this->volunteer = new Volunteer(null, $organization->getOrgId(), "notanemail@fake.com", null, "Jane", $hash, false, "Doe", "505-555-5555", $salt);

		// visit ourselves to get the XSRF-TOKEN cookie
		$this->guzzle = $client = new \GuzzleHttp\Client(["cookies" => true]);

		$output = $this->guzzle->request("GET", 'https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/');

		$cookies = $this->guzzle->getConfig()["cookies"];
		$token = $cookies->getCookieByName("XSRF-TOKEN");

	}


	public function testValidPost() {
		//set session to be an admin
		$_SESSION["volunteer"] = $this->admin;
		//send organization info to api in a put method (look up the dry method)
		$output = $this->guzzle->request("PUT", 'https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization');

		//get info from the api, and confirm it matches
		$output = $this->guzzle->request("GET", 'https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization'); //tack on the id

	}
	public function testInvalidPost() {
		//test to make sure non-admin can't put (same code would execute for put and delete, so test it here and not there)
		$_SESSION["volunteer"] = $this->volunteer;

	}
	public function testValidPut() {

	}
	public function testInvalidPut() {
		//test to make sure can't put to an organization that doesn't exist
		//question: what about the massive if block to check for empty fields?  can't do ALL of them
	}
	public function testValidDelete() {

	}
	public function testInvalidDelete() {
			//test to make sure can't delete organization that doesn't exist
	}

	public function testValidGet() {
		//test getting by parameter x

	}
	public function testInvalidGet() {
		//test getting something that doesn't exist
	}


}