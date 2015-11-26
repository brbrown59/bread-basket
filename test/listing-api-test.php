<?php

require_once ("bread-basket.php");
require_once dirname(__DIR__) . "/vendor/autoload.php";
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

/**
 * PHP unit test for the listing API
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 **/
class ListingApiTest extends BreadBasketTest {
	/**
	 * valid org Id by to use
	 * @var Int $VALID_ORGID = $this->organization->getOrgId()
	 **/
	protected $organization = null;
	/**
	 * valid listing claimed by to use
	 * @var Int $VALID_CLAIMEDBY
	 **/
	protected $VALID_CLAIMEDBY = 123459;
	/**
	 * valid listing closed
	 * @var Bool $VALID_LISTINGCLOSED
	 **/
	protected $VALID_LISTINGCLOSED = TRUE;
	/**
	 * valid listing cost
	 * @var Double $VALID_COST
	 **/
	protected $VALID_COST = 94.25;
	/**
	 * a second valid listing cost, for updating
	 * @var Double $VALID_COST_2
	 */
	protected $VALID_COST_2 = 211.53;
	/**
	 * valid listing memo
	 * @var String $VALID_MEMO
	 **/
	protected $VALID_MEMO = "We have lots of tomatoes. Come and get them";
	/**
	 * valid parentId
	 * @var Int $VALID_PARENT_ID
	 */
	protected $VALID_PARENT_ID = 5554268;
	/**
	 * valid listingPostTime
	 * @var DATETIME $VALID_DATETIME
	 **/
	protected $valid_datetime = null;
	/**
	 * valid listing type to use
	 * @var Int 	protected $listingType = null;
	 **/
	protected $listingType = null;

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
	 * set up for dependent objects
	 */
	public final function setUp() {
		//run default set-up method
		parent::setUp();

		//create new organization for the test volunteers
		$this->organization = new Organization(null, "123 Easy Street", '', "Albuquerque", "Feeding people since 1987", "9 - 5", "Food for Hungry People", "505-765-4321", "NM", "R", "87801");
		$this->organization->insert($this->getPDO());

		//create a new listing type
		$this->listingType = new ListingType(null, "Perishable");
		$this->listingType->insert($this->getPDO());

		//create a new volunteer to use as an admin for the tests
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password4321", $salt, 262144, 128);
		$this->admin = new Volunteer(null, $this->organization->getOrgId(), "fakeemail@fake.com", null, "John", $hash, true, "Doe", "505-123-4567", $salt);
		$this->admin->insert($this->getPDO());

		//create a non-admin volunteer for the tests
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash =  hash_pbkdf2("sha512", "password1234", $salt, 262144, 128);
		$this->volunteer = new Volunteer(null, $this->organization->getOrgId(), "notanemail@fake.com", null, "Jane", $hash, false, "Doe", "505-555-5555", $salt);
		$this->volunteer->insert($this->getPDO());

		//create the guzzle client
		$this->guzzle = new \GuzzleHttp\Client(["cookies" => true]);

		//visit ourselves to get the xsrf-token
		$this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/listing');
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
	 * test deleting a valid listing in the database
	 * */
	public function testValidDelete() {
		//create a new listing, and insert it
		$listing = new Listing(null, $this->organization->getOrgId(), $this->VALID_CLAIMEDBY, $this->VALID_LISTINGCLOSED, $this->VALID_COST, $this->VALID_MEMO,
			$this->VALID_PARENT_ID, $this->valid_datetime, $this->listingType->getlistingTypeId());
		$listing->insert($this->getPDO());

		//perform the actual delete
		$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/listing/' . $listing->getListingId(), [
			'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

		//grab the data from guzzle and enforce that the status codes are correct
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedListing = json_decode($body);
		$this->assertSame(200, $retrievedListing->status);

		//try retrieving entry from database and ensure it was deleted
		$deletedListing = Listing::getListingByListingId($this->getPDO(), $listing->getOrgId());
		$this->assertNull($deletedListing);
	}

}