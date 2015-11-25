<?php

require_once ("bread-basket.php");
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

/**
 * Class VolunteerApiTest is a PHPUnit test for the Volunteer class API
 *
 * this test checks both valid and invalid inputs
 *
 * @see Volunteer/index
 * @author Kimberly Keller <keller.kimberly@gmail.com> and co-authored with Bradley Brown <tall.white.ninja@gmail.com>
 */

class VolunteerApiTest extends BreadBasketTest {
	/**
	 * valid volunteer email to test with
	 * @var string $VALID_EMAIL
	 */
	protected $VALID_EMAIL = "lastweektonight@joliver.com";
	/**
	 * valid volunteer email activation;
	 * @var string $VALID_EMAIL_ACTIVATION
	 */
	protected $VALID_EMAIL_ACTIVATION = "0123456789abcdef";
	/**
	 * valid volunteer first name
	 * @var string $VALID_FIRST_NAME
	 */
	protected $VALID_FIRST_NAME = "John";
	/**
	 * valid volunteer last name
	 * @var string $VALID_LAST_NAME
	 */
	protected $VALID_LAST_NAME = "Oliver";
	/**
	 * valid volunteer as admin
	 * @var boolean $VALID_ADMIN
	 */
	protected $VALID_ADMIN = true;
	/**
	 * valid volunteer phone
	 * @var string $VALID_PHONE
	 */
	protected $VALID_PHONE = "180084474753425";
	/**
	 * valid phone alternative
	 * @var string $VALID_ALT_PHONE
	 */
	protected $VALID_ALT_PHONE ="5508675309";
	/**
	 * valid salt for volunteer
	 * @var string $salt
	 */
	protected $VALID_SALT;
	/**
	 * valid hash for volunteer
	 * @var string $hash
	 */
	protected $VALID_HASH;
	/**
	 * Guzzle client used to perform the tests
	 * @var GuzzleHttp/Client $guzzle
	 */
	protected $guzzle = null;
	/**
	 * XSRF token retrieved from the server
	 * @var string $token
	 */
	protected $token;
	/**
	 * valid organization to test with
	@var organization object $organization
	 */
	protected $organization;
	/**
	 * valid org id to test with
	 * @var int object $organization
	 */
	protected $valid_org_id;
	/**
	 * valid volunteer NOT admin test with
	 * @var string object $volunteer
	 */
	protected $volunteer = null;
	/**
	 * valid admin to test with
	 * @var string $admin
	 */
	protected $admin = null;

	/**
	 * set up for dependent objects before running each test
	 */
	public final function setUp() {
		//run default set-up method
		parent::setUp();

		//create salt and hash
		$this->VALID_HASH = hash_pbkdf2("sha512", "idonatefood", $this->VALID_SALT, 262144, 128);
		$this->VALID_SALT = bin2hex(openssl_random_pseudo_bytes(32));

		//create an organization for the volunteers to be a part of
		$organization = new Organization(null, "123 Easy Street", '', "Albuquerque", "Feeding people since 1987", "9 - 5", "Food for Hangry People", "505-765-4321", "NM", "R", "87801");
		$organization->insert($this->getPDO());

		$this->valid_org_id = $organization->getOrgId();

		//create a new volunteer to use as an admin for the tests
		//don't need to insert them into the database: just need their info to create sessions
		//for testing purposes, allow them to create organizations they're not associated with
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "coffeeblack", $salt, 262144, 128);
		$this->admin = new Volunteer(null, $organization->getOrgId(), "captain@voyager.com", null, "Kathryn", $hash, true, "Janeway", "505-123-4567", $salt);
		$this->admin->insert($this->getPDO());

		//create a non-admin volunteer for the tests
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password1234", $salt, 262144, 128);
		$this->volunteer = new Volunteer(null, $organization->getOrgId(), "notanemail@fake.com", null, "Jane", $hash, false, "Doe", "505-555-5555", $salt);
		$this->volunteer->insert($this->getPDO());

		//create the guzzle client
		$this->guzzle = new \GuzzleHttp\Client(["cookies" => true]);

		//visit ourselves to get the xsrf-token
		$this->guzzle->get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer');
		$cookies = $this->guzzle->getConfig()["cookies"];
		$this->token = $cookies->getCookieByName("XSRF-TOKEN")->getValue();


		//send a request to the sign-in method

		$adminLogin = new stdClass();
		$adminLogin->email = "captain@voyager.com";
		$adminLogin->password = "coffeeblack";
		$login = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/controllers/sign-in-controller.php', [
				'json' => $adminLogin,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

	}

	//test deleting a valid entry
	public function testValidDelete() {

		//create a new volunteer, and insert into the database
		$volunteer = new Volunteer(null, $this->valid_org_id, $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_ADMIN, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		// grab the data from guzzle and enforce that the status codes are correct
		$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer/' . $volunteer->getVolId(),
				['headers' => ['X-XSRF-TOKEN' => $this->token]
				]);
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedVol = json_decode($body);
		$this->assertSame(200, $retrievedVol->status);

		//try retrieving entry from database and ensuring it was deleted
		$deletedVol = Volunteer::getVolunteerByVolId($this->getPDO(), $volunteer->getVolId());
		var_dump($deletedVol);
		$this->assertNull($deletedVol);

	}

	public function testInvalidDelete() {
		//test to make sure can't delete organization that doesn't exist
		$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer/' . BreadBasketTest::INVALID_KEY,
				['headers' => ['X-XSRF-TOKEN' => $this->token]
				]);

		//make sure the request returns the proper error code for a failed operation
		$body = $response->getBody();
		$retrievedVol = json_decode($body);
		$this->assertSame(404, $retrievedVol->status);
	}

	public function testValidGetById() {
		//text parameter
	}

	public function testValidGetByOrgId () {

	}

	public function testValidGetByEmail () {

	}

	public function testValidGetByIsAdmin () {

	}

	public function testValidGetByPhone () {

	}

	public function testValidGetByEmailActivation() {

	}

	public function testInvalidGet() {

	}

	public function testValidPut() {
		//create a new volunteer, and insert into the database
		$volunteer = new Volunteer(null, $this->valid_org_id, $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH,
				$this->VALID_ADMIN, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		//update the volunteer
		$volunteer->setVolPhone($this->VALID_ALT_PHONE);

//		var_dump($volunteer->getVolId());
		//send the info to update the API
		$response = $this->guzzle->put('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer/' . $volunteer->getVolId(), [
				'allow-redirects' => ['strict' => true],
				'json' => $volunteer,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);
//		var_dump($response);
//		$newVolunteer = Volunteer::getVolunteerByVolId($this->getPDO(), $volunteer->getVolId());
//		var_dump($newVolunteer);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		var_dump((string)$response->getBody());
		$retrievedVol = json_decode($body);
//		var_dump($retrievedVol);
		$this->assertSame(200, $retrievedVol->status);

		//pull the value from the DB, and make sure it was properly updated
		$newvol = Volunteer::getVolunteerByVolId($this->getPDO(), $volunteer->getVolId());
		$this->assertSame($newvol->getVolPhone(), $this->VALID_ALT_PHONE);
	}

	public function testInvalidPut() {
		$volunteer = new Volunteer(BreadBasketTest::INVALID_KEY, $this->valid_org_id, $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH,
				$this->VALID_ADMIN, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$response = $this->guzzle->put('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer/' . BreadBasketTest::INVALID_KEY, [
				'allow-redirects' => ['strict' => true],
				'json' => $volunteer,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//make sure the request returns the proper error code for a failed operation
		$body = $response->getBody();
		$retrievedVol = json_decode($body);
		$this->assertSame(404, $retrievedVol->status);
	}



}