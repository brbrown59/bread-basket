`<?php
//grab the project test parameters
require_once("bread-basket.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/volunteer.php");
require_once(dirname(__DIR__) . "/public_html/php/classes/organization.php");

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
	 * valid org id to use
	 * @var int $VALID_ORG_ID
	 */
	protected $organization = null;
	/**
	 * valid email to use
	 * @var string $VALID_EMAIL
	 **/
	protected $VALID_EMAIL = "captain@voyager.com";
	/**
	 * valid email alt to use
	 * @var string $VALID_EMAIL_ALT
	 **/
	protected $VALID_EMAIL_ALT ="seven@voyager.com";
	/**
	 * valid activation key to use
	 * @var string $VALID_EMAIL_ACTIVATION
	 **/
	protected $VALID_EMAIL_ACTIVATION = "1234567898765432";
	/**
	 * valid first name
	 * @var string $VALID_FIRST_NAME
	 **/
	protected $VALID_FIRST_NAME = "Kathryn";
	/**
	 * valid hash
	 * @var string $VALID_HASH
	 */
	protected $VALID_HASH;
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
	 * valid salt
	 * @var string $VALID_SALT
	 */
	protected $VALID_SALT;

	/**
	 * set up for dependent objects before running each test
	 */
	public final function setUp() {
		//run default setUp() method first
		parent::setUp();

		//create a salt and hash for test
		$this->VALID_SALT = bin2hex(openssl_random_pseudo_bytes(32));
		$this->VALID_HASH = $this->VALID_HASH = hash_pbkdf2("sha512", "password4321", $this->VALID_SALT, 262144, 128);

		//create a valid organization to reference in test
		$this->organization = new Organization(null, "23 Star Trek Rd", "Suit 2", "Bloomington", "Coffee, black", "24/7", "Enterprise", "5051234567", "NM", "G", "87106" );
		$this->organization->insert($this->getPDO());

	}


	/**
	 * test inserting a valid Volunteer and verity that the actual mySQL data matches
	 **/
	public function testInsertValidVolunteer() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("volunteer");

		//create a new Volunteer and insert into mySQL
		$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoVolunteer = Volunteer::getVolunteerByVolId($this->getPDO(), $volunteer->getVolId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("volunteer"));
		$this->assertSame($pdoVolunteer->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoVolunteer->getVolEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoVolunteer->getVolEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoVolunteer->getVolFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoVolunteer->getVolHash(), $this->VALID_HASH);
		$this->assertSame($pdoVolunteer->getVolLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoVolunteer->getVolPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoVolunteer->getVolSalt(), $this->VALID_SALT);
	}

	/**
	 * test inserting a Volunteer that already exists
	 *
	 * @expectedException PDOException
	 **/
	public function testInsertInvalidVolunteer() {
		//create a volunteer wiht a non null volId and watch it fail
		$volunteer = new Volunteer(BreadBasketTest::INVALID_KEY, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());
	}

	/**
	 * test inserting a Volunteer, editing it, and then updating it
	 **/
	public function testUpdateValidVolunteer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("volunteer");

		// create a new Volunteer and insert to into mySQL
		$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		// edit the Volunteer and update it in mySQL
		$volunteer->setVolEmail($this->VALID_EMAIL_ALT);
		$volunteer->update($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoVolunteer = Volunteer::getVolunteerByVolId($this->getPDO(), $volunteer->getVolId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("volunteer"));
		$this->assertSame($pdoVolunteer->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoVolunteer->getVolEmail(), $this->VALID_EMAIL_ALT);
		$this->assertSame($pdoVolunteer->getVolEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoVolunteer->getVolFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoVolunteer->getVolHash(), $this->VALID_HASH);
		$this->assertSame($pdoVolunteer->getVolLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoVolunteer->getVolPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoVolunteer->getVolSalt(), $this->VALID_SALT);
	}

	/**
	 * test updating a Volunteer that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testUpdateInvalidVolunteer() {
		//create a Volunteer and try to update it without actually inserting it
		$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME,$this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->update($this->getPDO());
	}

	/**
	 * test creating a Volunteer and then deleting it
	 **/
	public function testDeleteValidVolunteer() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("volunteer");

		// create a new Volunteer and insert to into mySQL
		$volunteer = new Volunteer(null,$this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		//delete the Volunteer from mySQL
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("volunteer"));
		$volunteer->delete($this->getPDO());

		//grab the data from mySQL and enforce the Volunteer does not exist
		$pdoVolunteer = Volunteer::getVolunteerByVolId($this->getPDO(), $volunteer->getVolId());
		$this->assertNull($pdoVolunteer);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("volunteer"));
	}

	/**
	 * test deleting a Volunteer that does not exist
	 *
	 * @expectedException PDOException
	 **/
	public function testDeleteInvalidVolunteer() {
		// create a Volunteer and try to delete it without actually inserting it
		$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->delete($this->getPDO());
	}


	/**
	 * test inserting a Volunteer and regrabbing it from mySQL
	 */
	public function testGetValidVolunteerByVolId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("volunteer");

		// create a new Volunteer and insert to into mySQL
		$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoVolunteer = Volunteer::getVolunteerByVolId($this->getPDO(), $volunteer->getVolId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("volunteer"));
		$this->assertSame($pdoVolunteer->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoVolunteer->getVolEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoVolunteer->getVolEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoVolunteer->getVolFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoVolunteer->getVolHash(), $this->VALID_HASH);
		$this->assertSame($pdoVolunteer->getVolLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoVolunteer->getVolPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoVolunteer->getVolSalt(), $this->VALID_SALT);
	}

	/**
	 * test grabbing a volunteer that does not exist
	 **/
	public function testGetInvalidVolunteerByVolId() {
		//grab a volunteer id that exceeds the maximum allowable volunteer id
		$volunteer = Volunteer::getVolunteerByVolId($this->getPDO(), BreadBasketTest::INVALID_KEY);
		$this->assertNull($volunteer);
	}

	/**
	 * test grabbing a volunteer by org id
	 */
	public function testGetValidVolunteerByOrgId() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("volunteer");

		// create a new Volunteer and insert to into mySQL
		$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoVolunteer = Volunteer::getVolunteerByOrgId($this->getPDO(), $volunteer->getOrgId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("volunteer"));
		$this->assertSame($pdoVolunteer[0]->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoVolunteer[0]->getVolEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoVolunteer[0]->getVolEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoVolunteer[0]->getVolFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoVolunteer[0]->getVolHash(), $this->VALID_HASH);
		$this->assertSame($pdoVolunteer[0]->getVolLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoVolunteer[0]->getVolPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoVolunteer[0]->getVolSalt(), $this->VALID_SALT);
	}

	/**
	 * test grabbing a volunteer by an org id that does not exist
	 */
	public function testGetInvalidVolunteerByOrgId() {
		//grab an organization that does not exists
		$volunteer = Volunteer::getVolunteerByOrgId($this->getPDO(), "10000000000000000");
		$this->assertSame($volunteer->getSize(), 0);
	}

	/**
	 * test grabbing a volunteer by email
	 **/
	public function testGetValidVolunteerByVolEmail() {
			// count the number of rows and save it for later
			$numRows = $this->getConnection()->getRowCount("volunteer");

			// create a new Volunteer and insert to into mySQL
			$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
			$volunteer->insert($this->getPDO());

			// grab the data from mySQL and enforce the fields match our expectations
			$pdoVolunteer = Volunteer::getVolunteerByVolEmail($this->getPDO(), $volunteer->getVolEmail());
			$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("volunteer"));
			$this->assertSame($pdoVolunteer[0]->getOrgId(), $this->organization->getOrgId());
			$this->assertSame($pdoVolunteer[0]->getVolEmail(), $this->VALID_EMAIL);
			$this->assertSame($pdoVolunteer[0]->getVolEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
			$this->assertSame($pdoVolunteer[0]->getVolFirstName(), $this->VALID_FIRST_NAME);
			$this->assertSame($pdoVolunteer[0]->getVolHash(), $this->VALID_HASH);
			$this->assertSame($pdoVolunteer[0]->getVolLastName(), $this->VALID_LAST_NAME);
			$this->assertSame($pdoVolunteer[0]->getVolPhone(), $this->VALID_PHONE);
			$this->assertSame($pdoVolunteer[0]->getVolSalt(), $this->VALID_SALT);
		}

	/**
	 * test grabbing a volunteer by an email that does not exist
	 */
	public function testGetInvalidVolunteerByVolEmail() {
		//grab an email that does not exist
		$volunteer = Volunteer::getVolunteerByVolEmail($this->getPDO(), "notcaptain@voyager.com");
		$this->assertSame($volunteer->getSize(), 0);
	}

	/**
	 * test grabbing a volunteer by first and last name
	 */
	public function testGetValidVolunteerByVolFirstAndLastName() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("volunteer");

		// create a new Volunteer and insert to into mySQL
		$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoVolunteer = Volunteer::getVolunteerByVolFirstAndLastName($this->getPDO(), $volunteer->getVolFirstName(), $volunteer->getVolLastName());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("volunteer"));
		$this->assertSame($pdoVolunteer[0]->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoVolunteer[0]->getVolEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoVolunteer[0]->getVolEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoVolunteer[0]->getVolFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoVolunteer[0]->getVolHash(), $this->VALID_HASH);
		$this->assertSame($pdoVolunteer[0]->getVolLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoVolunteer[0]->getVolPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoVolunteer[0]->getVolSalt(), $this->VALID_SALT);
	}

	/**
	 * test grabbing an invalid volunteer by first and last name
	 */
	public function testGetInvalidVolunteerByVolFirstaAndLastName() {
		//grab a volunteer first and last name that does not exist
		$volunteer = Volunteer::getVolunteerByVolFirstAndLastName($this->getPDO(), "Tom", "Paris");
		$this->assertSame($volunteer->getSize(), 0);
	}

	/**
	 * test grabbing a volunteer by phone number
	 */
	public function testGetVolunteerByVolPhone() {
		// count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("volunteer");

		// create a new Volunteer and insert to into mySQL
		$volunteer = new Volunteer(null, $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_HASH, $this->VALID_LAST_NAME, $this->VALID_PHONE, $this->VALID_SALT);
		$volunteer->insert($this->getPDO());

		// grab the data from mySQL and enforce the fields match our expectations
		$pdoVolunteer = Volunteer::getVolunteerByVolPhone($this->getPDO(), $volunteer->getVolPhone());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("volunteer"));
		$this->assertSame($pdoVolunteer[0]->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoVolunteer[0]->getVolEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoVolunteer[0]->getVolEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoVolunteer[0]->getVolFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoVolunteer[0]->getVolHash(), $this->VALID_HASH);
		$this->assertSame($pdoVolunteer[0]->getVolLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoVolunteer[0]->getVolPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoVolunteer[0]->getVolSalt(), $this->VALID_SALT);
	}

	/**
	 * test grabbing a volunteer by invalid phone number
	 */
	public function testGetInvalidVolunteerByVolPhone() {
		//grab a volunteer first and last name that does not exist
		$volunteer = Volunteer::getVolunteerByVolPhone($this->getPDO(), "12345678910");
		$this->assertSame($volunteer->getSize(), 0);
	}




}