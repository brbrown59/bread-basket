<?php

require_once ("bread-basket.php");
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

/**
 * Full PHPUnit test for the organization API
 *
 * This is a complete PHPUnit test of the organization API.
 *
 * @see organization\index.php
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 **/
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
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password4321", $salt, 262144, 128);
		$this->admin = new Volunteer(null, $organization->getOrgId(), "fakeemail@fake.com", null, "John", $hash, true, "Doe", "505-123-4567", $salt);
		$this->admin->insert($this->getPDO());

		//create a non-admin volunteer for the tests
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password1234", $salt, 262144, 128);
		$this->volunteer = new Volunteer(null, $organization->getOrgId(), "notanemail@fake.com", null, "Jane", $hash, false, "Doe", "505-555-5555", $salt);
		$this->volunteer->insert($this->getPDO());

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


	/**
	 * test deleting a valid organization in the database
	 */
	public function testValidDelete() {

		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//perform the actual delete
		$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/' . $organization->getOrgId(),
				['headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		// grab the data from guzzle and enforce that the status codes are correct
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

		//try retrieving entry from database and ensuring it was deleted
		$deletedOrg = Organization::getOrganizationByOrgId($this->getPDO(), $organization->getOrgId());
		$this->assertNull($deletedOrg);

	}

	/**
	 * test deleting an object that doesn't exist
	 */
	public function testInvalidDelete() {
		$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/' . BreadBasketTest::INVALID_KEY,
				['headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//make sure the request returns the proper error code for a failed operation
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(404, $retrievedOrg->status);
	}

	/**
	 * test getting a valid object by ID
	 */
	public function testValidGetById() {
		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//send the get request to the API
		$response = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/' . $organization->getOrgId(), [
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

		//ensure the returned values meet expectations (just checking enough to make sure the right thing was obtained)
		$this->assertSame($retrievedOrg->data->orgId, $organization->getOrgId());
		$this->assertSame($retrievedOrg->data->orgName, $this->VALID_NAME);

	}

	/**
	 * test getting a valid organization by city
	 */
	public function testValidGetByCity() {
		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//send the get request to the API
		$response = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/?\'city\'=\'' . $this->VALID_CITY . '\'', [
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

		//ensure the returned values meet expectations just checking (enough to make sure the right thing was obtained)
		//0th entry is the organization for the volunteers, so need to check against the 1st
		$this->assertSame($retrievedOrg->data[1]->orgId, $organization->getOrgId());
		$this->assertSame($retrievedOrg->data[1]->orgCity, $this->VALID_CITY);

	}

	/**
	 * test getting a valid organization by name
	 */
	public function testValidGetByName() {
		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//send the get request to the API
		$response = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/?\'name\'=\'' . $this->VALID_NAME . '\'', [
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

		//ensure the returned values meet expectations just checking (enough to make sure the right thing was obtained)
		//0th entry is the organization for the volunteers, so need to check against the 1st
		$this->assertSame($retrievedOrg->data[1]->orgId, $organization->getOrgId());
		$this->assertSame($retrievedOrg->data[1]->orgName, $this->VALID_NAME);

	}

	/**
	 * test getting a valid organization by state
	 */
	public function testValidGetByState() {
		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//send the get request to the API
		$response = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/?\'state\'=\'' . $this->VALID_STATE . '\'', [
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

		//ensure the returned values meet expectations just checking (enough to make sure the right thing was obtained)
		//0th entry is the organization for the volunteers, so need to check against the 1st
		$this->assertSame($retrievedOrg->data[1]->orgId, $organization->getOrgId());
		$this->assertSame($retrievedOrg->data[1]->orgState, $this->VALID_STATE);

	}

	/**
	 * test getting valid organization by type
	 */
	public function testValidGetByType() {
		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//send the get request to the API
		$response = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/?\'type\'=\'' . $this->VALID_TYPE . '\'', [
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

		//ensure the returned values meet expectations just checking (enough to make sure the right thing was obtained)
		//0th entry is the organization for the volunteers, so need to check against the 1st
		$this->assertSame($retrievedOrg->data[1]->orgId, $organization->getOrgId());
		$this->assertSame($retrievedOrg->data[1]->orgType, $this->VALID_TYPE);

	}

	/**
	 * test getting valid organization by zip code
	 */
	public function testValidGetByZip() {
		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//send the get request to the API
		$response = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/?\'zip\'=\'' . $this->VALID_ZIP . '\'', [
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

		//ensure the returned values meet expectations just checking (enough to make sure the right thing was obtained)
		//0th entry is the organization for the volunteers, so need to check against the 1st
		$this->assertSame($retrievedOrg->data[1]->orgId, $organization->getOrgId());
		$this->assertSame($retrievedOrg->data[1]->orgZip, $this->VALID_ZIP);

	}

	/**
	 * test getting all organizations
	 */
	public function testValidGetAll() {
		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//send the get request to the API
		$response = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization', [
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

		//ensure the response returned a non-empty array
		$this->assertGreaterThan(0, sizeof($retrievedOrg->data));
	}

	/**
	 * test getting something that doesn't exist
	 * only testing one case, because these errors are really handled by the class, which has already been tested
	 */
	public function testInvalidGet() {
		//send the get request to the API
		$response = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/' . BreadBasketTest::INVALID_KEY, [
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$retrievedOrg = get_object_vars($retrievedOrg);

		//assert that there is no data object in the response
		$this->assertArrayNotHasKey('data', $retrievedOrg);
	}


	/**
	 * test putting a valid organization into the API
	 */
	public function testValidPut() {
		//create a new organization, and insert into the database
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//update the organization
		$organization->setOrgName($this->VALID_NAME_ALT);

		//send the info to update to the API
		$response = $this->guzzle->put('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/' . $organization->getOrgId(), [
				'allow-redirects' => ['strict' => true],
				'json' => $organization,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(200, $retrievedOrg->status);

		//pull the value from the DB, and make sure it was properly updated
		$neworg = Organization::getOrganizationByOrgId($this->getPDO(), $organization->getOrgId());
		$this->assertSame($neworg->getOrgName(), $this->VALID_NAME_ALT);
	}

	/**
	 * test putting an invalidvalid organization into the API
	 */
	public function testInvalidPut() {
		//test to make sure can't put to an organization that doesn't exist
		$organization = new Organization(BreadBasketTest::INVALID_KEY, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$response = $this->guzzle->put('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/' . BreadBasketTest::INVALID_KEY,[
				'allow-redirects' => ['strict' => true],
				'json' => $organization,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//make sure the request returns the proper error code for a failed operation
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);
		$this->assertSame(404, $retrievedOrg->status);

	}

	/**
	 * test posting a valid organization to the API
	 */
	public function testValidPost() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization to send
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);

		//send organization info to api in a post method, also make sure the cookie is set
		$response = $this->guzzle->request('POST', 'https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization', [
				'allow_redirects' => ['strict' => true],
				'json' => $organization,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);
		//make sure the status codes match
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);

		$this->assertSame(200, $retrievedOrg->status);

		//ensure a new row was added to the database
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
	}

	/**
	 * test posting an invalid organization to the API
	 */
	public function testInvalidPost() {
		//test to make sure non-admin can't post
		//sign out as an admin, log-in as a volunteer
		$logout = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/controllers/sign-out-controller.php');


		$volLogin = new stdClass();
		$volLogin->email = "notanemail@fake.com";
		$volLogin->password = "password1234";
		$login = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/controllers/sign-in-controller.php', [
				'allow_redirects' => ['strict' => true],
				'json' => $volLogin,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//try to post to an organization
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
				$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);

		$response = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization', [
				'allow_redirects' => ['strict' => true],
				'json' => $organization,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedOrg = json_decode($body);

		//make sure the organization was not entered into the database
		$shouldNotExist = Organization::getOrganizationByOrgName($this->getPDO(), $this->VALID_NAME);
		$this->assertSame($shouldNotExist->getSize(), 0);

		//make sure 401 error is returned for trying to access an admin method as a volunteer
		$this->assertSame(401, $retrievedOrg->status);
	}

}