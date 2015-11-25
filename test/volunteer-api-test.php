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
	protected $organization = null;

	/**
	 * set up for dependent objects before running each test
	 */
	public final function setUp() {
		//run default set-up method
		parent::setUp();

		//create salt and hash
		$this->VALID_HASH = hash_pbkdf2("sha512", "password1234", $this->VALID_salt, 262144, 128);
		$this->VALID_SALT = bin2hex(openssl_random_pseudo_bytes(32));

		//create an organization for the volunteers to be a part of
		$organization = new Organization(null, "123 Easy Street", '', "Albuquerque", "Feeding people since 1987", "9 - 5", "Food for Hungry People", "505-765-4321", "NM", "R", "87801");
		$organization->insert($this->getPDO());


		//create the guzzle client
		$this->guzzle = new \GuzzleHttp\Client(["cookies" => true]);

		//visit ourselves to get the xsrf-token
		$this->guzzle->get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization');
		$cookies = $this->guzzle->getConfig()["cookies"];
		$this->token = $cookies->getCookieByName("XSRF-TOKEN")->getValue();


		//send a request to the sign-in method

		$adminLogin = new stdClass();
		$adminLogin->email = "lastweektonight@joliver.com";
		$adminLogin->password = "idonatefood";
		$login = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/controllers/sign-in-controller.php', [
				'json' => $adminLogin,
				'headers' => ['X-XSRF-TOKEN' => $this->token]
		]);

	}

	//test deleting a valid entry
	public function testValidDelete() {

		//create a new organization, and insert into the database
		$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_ADMIN, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		// grab the data from guzzle and enforce that the status codes are correct
		$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/' . $organization->getOrgId(),
				['headers' => ['X-XSRF-TOKEN' => $this->token]
				]);
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedVol = json_decode($body);
		$this->assertSame(200, $retrievedVol->status);

		//try retrieving entry from database and ensuring it was deleted
		$deletedVol = Volunteer::getVolunteerByVolId($this->getPDO(), $volunteer->getOrgId());
		$this->assertNull($deletedVol);

	}

	public function testInvalidDelete() {
		//test to make sure can't delete organization that doesn't exist
		$response = $this->guzzle->delete('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/organization/' . BreadBasketTest::INVALID_KEY,
				['headers' => ['X-XSRF-TOKEN' => $this->token]
				]);

		//make sure the request returns the proper error code for a failed operation
		$body = $response->getBody();
		$retrievedVol = json_decode($body);
		$this->assertSame(404, $retrievedVol->status);
	}



}