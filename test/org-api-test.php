<?php

require_once ("bread-basket.php");
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

class OrganizationApiTest extends BreadBasketTest {
	/**
	 * valid organization address first line to use
	 * @var String $VALID_ADDRESS1
	 */
	protected $VALID_ADDRESS1 = "123 Easy Street";
	/**
	 * valid organization address second line to use
	 * @var String $VALID_ADDRESS2
	 */
	protected $VALID_ADDRESS2 = "Suite 456";
	/**
	 * valid organization city to use
	 * @var String $VALID_CITY
	 */
	protected $VALID_CITY = "Albuquerque";
	/**
	 * valid organization description to use
	 * @var String $VALID_DESCRIPTION
	 */
	protected $VALID_DESCRIPTION = "Providing food to the most in-need citizens in Albuquerque";
	/**
	 * valid organization hours to use
	 * @var String $VALID_HOURS
	 */
	protected $VALID_HOURS = "9:00AM - 5:00PM";
	/**
	 * valid organization name to use
	 * @var String $VALID_NAME
	 */
	protected $VALID_NAME = "Feed Peeps";
	/**
	 * a second valid organization name to use
	 * @var String $VALID_NAME2
	 */
	protected $VALID_NAME_ALT = "Keeping ABQ Fed";
	/**
	 * valid organization phone number to use
	 * @var String $VALID_PHONE
	 */
	protected $VALID_PHONE = "5055551212";
	/**
	 * valid organization state code to use
	 * @var String $VALID_STATE
	 */
	protected $VALID_STATE = "NM";
	/**
	 * valid organization type to use
	 * @var String $VALID_TYPE
	 */
	protected $VALID_TYPE = "G";
	/**
	 * valid organization zip code to use
	 * @var String $VALID_ZIP
	 */
	protected $VALID_ZIP = "87102";
	/**
	 * Guzzle client used to perform the tests
	 * @var GuzzleHttp/Client $guzzle
	 */
	protected $guzzle = null;
	/**
	 * XSRF token retrieved from the server
	 * @var String $token
	 */
	protected $token;
	/**
	 * vaild admin user to test with
	 * @var volunteer object $admin
	 */
	protected $admin = null;
	/**
	 * vaild volunteer user to test with
	 * @var volunteer object $volunteer
	 */
	protected $volunteer = null;

	/**
	 * set up for dependent objects before running each test
	 */
	public final function setUp() {
		//run default set-up method
		parent::setUp();

		//create a new organization for the test volunteers to belong
		$organization = new Organization(null, "123 Easy Street", '', "Albuquerque", "Feeding people since 1987", "9 - 5", "Food for Hungry People", "505-765-4321", "NM", "R", "87801");
		$organization->insert($this->getPDO());

		//create a new volunteer to use as an admin for the tests
		//don't need to insert them into the database: just need their info to create sessions
		//for testing purposes, allow them to create organizations they're not associated with
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password4321", $salt, 262144, 128);
		$this->admin = new Volunteer(null, $organization->getOrgId(), "fakeemail@fake.com", null, "John", $hash, true, "Doe", "505-123-4567", $salt);
		$this->admin->insert($this->getPDO());

		//create a non-admin volunteer for the tests
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password1234", $salt, 262144, 128);
		$this->volunteer = new Volunteer(null, $organization->getOrgId(), "notanemail@fake.com", null, "Jane", $hash, false, "Doe", "505-555-5555", $salt);

		//create the guzzle client
		$this->guzzle = new \GuzzleHttp\Client(["cookies" => true]);

		//visit ourselves to get the xsrf-token
		$this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization');
		$cookies = $this->guzzle->getConfig()["cookies"];
		$this->token = $cookies->getCookieByName("XSRF-TOKEN")->getValue();


		//send a request to the sign-in method

		$adminLogin = new stdClass();
		$adminLogin->email = "fakeemail@fake.com";
		$adminLogin->password = "password4321";
		$login = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/controllers/sign-in-controller.php', [
				'json' => $adminLogin,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

	}


	//test deleting a valid entry
	public function testValidDelete() {
		//set session to be an admin
		//this needs to be sent with the request, somehow
		//$_SESSION["volunteer"] = $this->admin;


		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		// grab the data from guzzle and enforce that the status codes are correct
		//this directory path's not going to work on anyone else's deployment...
		//also, need to worry about the sessions
		$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/' . $organization->getOrgId(),
				['headers' => ['X-XSRF-TOKEN' => $this->token]
		]);
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

	}
	/*
	public function testInvalidDelete() {
		//test to make sure can't delete organization that doesn't exist
	}


	public function testValidPost() {
		//set session to be an admin
		//$_SESSION["volunteer"] = $this->admin;

		//create a new organization to send
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);

		//send organization info to api in a post method, also make sure the cookie is set
		//TODO: does session info need to be set in header?
		$response = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization', [
				'json' => $organization,
				'headers' => ['X-XSRF-TOKEN' => $this->token] //session here?
		]);
		//make sure the status codes match
		//...do we not check to make sure the content matches expectations?
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

	}
	public function testInvalidPost() {
		//test to make sure non-admin can't put (same code would execute for put and delete, so test it here and not there)
		$_SESSION["volunteer"] = $this->volunteer;

	}
	public function testValidPut() {
		//test putting to an organization

	}
	public function testInvalidPut() {
		//test to make sure can't put to an organization that doesn't exist
		//question: what about the massive if block to check for empty fields?  can't do ALL of them
	}


	public function testValidGet() {
		//test getting by parameter x

	}
	public function testInvalidGet() {
		//test getting something that doesn't exist
	}
*/

}