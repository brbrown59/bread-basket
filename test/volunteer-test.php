<?php
//grab the project test parameters
require_once("bread-basket.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "public_html/php/classes/volunteer.php");

/**
 * full PHP unit test for the Volunteer class
 *
 * tjos os a complete PHPUnit test of the Volunteer class. It is complete because ALL mySQL/PDO enabled methods
 * are tested for both invalid and valid inputs.
 *
 * @see Volunteer
 * @author Kimberly Keller <kimberly@gravitaspublications.com>
 **/
class VolunteerTest extends BreadBasketTest {
	/**
	 * valid email to use
	 * @var string $VALID_EMAIL
	 **/
	protected $VALID_EMAIL = "captain@voyager.com";
	/**
	 * valid activation key to use
	 * @var string $VALID_EMAIL_ACTIVATION
	 **/
	protected $VALID_EMAIL_ACTIVATION = "12345678ABCDEFGH";
	/**
	 * valid first name
	 * @var string $VALID_FIRST_NAME
	 **/
	protected $VALID_FIRST_NAME = "Kathryn";
	/**
	 * valid last name
	 * @var string $VALID_LAST_NAME
	 **/
	protected $VALID_LAST_NAME = "Janeway";
	/**
	 * valid phone number
	 * @var string $VALID_PHONE
	 **/
	protected $VALID_PHONE = "5053041090";

	/**
	 * test inserting a valid Volunteer and verity that the actual mySQL data matches
	 **/
	public function testInsertValidVolunteer() {
		//
	}
}