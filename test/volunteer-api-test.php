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
	 * valid password for volunteer
	 * @var string $password
	 */
	protected $VALID_PASSWORD = "idonatefood";
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

		//create an organization for the volunteers to be a part of.

	}

}