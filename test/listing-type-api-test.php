<?php

require_once("bread-basket.php");
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

/**
 * Class ListingTypeApiTest
 *
 * This is a test of the listing type class.
 *
 * @see ListingType
 */
class ListingTypeApiTest extends BreadBasketTest {

	//Todo do I really not need a listingID to test?
	/**
	 * valid listing type to use
	 * @var String $VALID_TYPE
	 */
	protected $VALID_TYPE = "Perishable";

	/**
	 * valid listing type to use
	 * @var String $VALID_TYPE
	 */
	protected $VALID_TYPE_2 = "Refrigerated";

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
	 * valid admin user to test with
	 * @var volunteer object $admin
	 */
	protected $admin = null;
	/**
	 * valid volunteer user to test with
	 * @var volunteer object $volunteer
	 */
	protected $volunteer = null;

	/**
	 * set up for dependents before running each test
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
		$this->volunteer->insert($this->getPDO());

////		//create a new listingType for the test
//		$listingType = new ListingType(null, 'Perishable');
//		$listingType->insert($this->getPDO());


		//create the guzzle client
		$this->guzzle = new \GuzzleHttp\Client(["cookies" => true]);

		//visit ourselves to get the xsrf-token
		$this->guzzle->get('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype');
		$cookies = $this->guzzle->getConfig()["cookies"];
		$this->token = $cookies->getCookieByName("XSRF-TOKEN")->getValue();

		//send a request to the sign-in method

		$adminLogin = new stdClass();
		$adminLogin->email = "fakeemail@fake.com";
		$adminLogin->password = "password4321";
		$login = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype', [
				'json' => $adminLogin,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

	}


	public function testValidGet() {
		//test getting by parameter new listing type
		//create a new listing type, and insert into the database
		$listingType = new ListingType(null, $this->VALID_TYPE);
		$listingType->insert($this->getPDO());

		//send the get request to the API
		$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/' . $listingType->getListingTypeId(),
				['headers' => ['X-XSRF-TOKEN' => $this->token]
				]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedListingType = json_decode($body);
		$this->assertSame(200, $retrievedListingType->status);

		//ensure the returned values meet expectations (just checking enough to make sure the right thing was obtained)
		$this->assertSame($retrievedListingType->data->listingTypeId, $listingType->getListingTypeById());
		$this->assertSame($retrievedListingType->data->listingTypeInfo, $this->VALID_TYPE);

	}

	public function testValidGetAll() {
			//test getting all new listing type
			//create a new listing type, and insert into the database
			$listingType = new ListingType(null, $this->VALID_TYPE_2);
			$listingType->insert($this->getPDO());

			//send the get request to the API
			$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/' . $listingType->getListingTypeId(),
					['headers' => ['X-XSRF-TOKEN' => $this->token]
					]);

			//ensure the response was sent, and the api returned a positive status
			$this->assertSame($response->getStatusCode(), 200);
			$body = $response->getBody();
			$retrievedListingType = json_decode($body);
			$this->assertSame(200, $retrievedListingType->status);

			//ensure the returned values meet expectations (just checking enough to make sure the right thing was obtained)
			$this->assertSame($retrievedListingType->data->listingTypeId, $listingType->getAllListingTypes());
			$this->assertSame($retrievedListingType[0]->data->listingTypeInfo, $this->VALID_TYPE);
		}
	}

