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

//		//create a new listingType for the test
		$listingType = new ListingType(null, 'Perishable');
		$listingType->insert($this->getPDO());


		//create the guzzle client
		$this->guzzle = new \GuzzleHttp\Client(["cookies" => true]);

		//visit ourselves to get the xsrf-token Todo needs to change based on where this is run
		$this->guzzle->get('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype');
		$cookies = $this->guzzle->getConfig()["cookies"];
		$this->token = $cookies->getCookieByName("XSRF-TOKEN")->getValue();

	}


		//test deleting a valid entry
		public function testValidDelete() {

			//create a new listing type, and insert into the database
			$listingType = new ListingType(null, $this->VALID_TYPE);
			$listingType->insert($this->getPDO());

			// grab the data from guzzle and enforce that the status codes are correct
			$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/' . $listingType->getListingTypeId(),
				['headers' => ['X-XSRF-TOKEN' => $this->token]
				]);
			$this->assertSame($response->getStatusCode(), 200);
			$body = $response->getBody();
			$retrievedListingType = json_decode($body);
			$this->assertSame(200, $retrievedListingType->status);

			//try retrieving entry from database and ensuring it was deleted
			$deletedListingType = ListingType::getListingTypeById($this->getPDO(), $listingType->getListingTypeId());
			$this->assertNull($deletedListingType);

		}

		public function testInvalidDelete() {
			//test to make sure can't delete organization that doesn't exist
			$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/' . BreadBasketTest::INVALID_KEY,
				['headers' => ['X-XSRF-TOKEN' => $this->token]
				]);

			//make sure the request returns the proper error code for a failed log-in
			$body = $response->getBody();
			$retrievedListingType = json_decode($body);
			$this->assertSame(404, $retrievedListingType->status);
		}


		public function testValidGet() {
			//test getting by parameter x

		}

		public function testInvalidGet() {
			//test getting something that doesn't exist
		}


		public function testValidPut() {
			//create a new listing type, and insert into the database
			$listingType = new ListingType(null, $this->VALID_TYPE);
			$listingType->insert($this->getPDO());


			//update the Listing type
			$listingType = new ListingType(null, $this->VALID_TYPE_2);

			//send the info to update to the API
			$response = $this->guzzle->put('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/', [
				'json' => $listingType,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
			]);

			//ensure the response was sent, and the api returned a positive status
			$this->assertSame($response->getStatusCode(), 200);
			$body = $response->getBody();
			$retrievedListingType = json_decode($body);
			$this->assertSame(200, $retrievedListingType->status);

			//get the organization from the dB and compare values?

		}

		public function testInvalidPut() {
			//test to make sure can't put to an organization that doesn't exist
			//question: what about the massive if block to check for empty fields?  can't do ALL of them
		}


		public function testValidPost() {

			//create a new listing type, and insert into the database
			$listingType = new ListingType(null, $this->VALID_TYPE);
			$listingType->insert($this->getPDO());

			//send organization info to api in a post method, also make sure the cookie is set
			$response = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/', [
				'json' => $listingType,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
			]);
			//make sure the status codes match
			$this->assertSame($response->getStatusCode(), 200);
			$body = $response->getBody();
			$retrievedListingType = json_decode($body);
			$this->assertSame(200, $retrievedListingType->status);

			//retrieve from DB and make sure it matches?

		}

		public function testInvalidPost() {
			//test to make sure non-admin can't post
			//sign out as an admin, log-in as a volunteer
			$logout = $this->guzzle->get('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/');


			$volLogin = new stdClass();
			$volLogin->email = "notanemail@fake.com";
			$volLogin->password = "password1234";
			$login = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/controllers/sign-in-controller.php', [
				'json' => $volLogin,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
			]);

			//try to post a listingType
			$listingType = new ListingType(null, $this->VALID_TYPE_2);

			$response = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/', [
				'json' => $listingType,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
			]);

			$this->assertSame($response->getStatusCode(), 200);
			$body = $response->getBody();
			$retrievedListingType = json_decode($body);

			//make sure the organization was not entered into the database
			$shouldNotExist = ListingType::getListingByTypeInfo($this->getPDO(), $this->VALID_TYPE_2);
			$this->assertSame($shouldNotExist->getSize(), 0);

			//make sure 401 error is returned for trying to access an admin method as a volunteer
			$this->assertSame(401, $retrievedListingType->status);
		}


	}
