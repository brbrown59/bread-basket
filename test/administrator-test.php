

<?php
//grab the project test parameters


require_once("bread-basket.php");


//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/administrator.php");
require_once(dirname(__DIR__) . "/public_html/php/classes/volunteer.php");
require_once(dirname(__DIR__) . "/public_html/php/classes/organization.php");

/**full PHP unit test for the administrator class
 *
 * A complete PHPUnit test of the administrator class. It is complete
 * because ALL mySQL/PDO enable methods are tested for invalid and valid inputs.
 *
 * @see Administrator
 * @author Carlos Beraun <cberaun2@cnm.edu>
 */

class AdministratorTest extends BreadBasketTest {
	/**
	 * valid admin id to use
	 * @var int $VALID_VOL_ID
	 */
	protected $volunteer = null;


	/**
	 * valid admin id to use
	 * @var int $VALID_ORG_ID
	 */
	protected $organization = null;


	/**
	 * Valid email alto use
	 * @var string $VALID_EMAIL
	 */
	protected $VALID_EMAIL = "person1@sample.com";


	/**
	 * valid email alt to use
	 * @var string $VALID_EMAIL_ALT
	 */
	protected $VALID_EMAIL_ALT = "person2@sample.com";


	/**
	 * valid activation key to use
	 * @var string $VALID_EMAIL_ACTIVATION
	 */
	protected $VALID_EMAIL_ACTIVATION = "12345678912345678";


	/**
	 * valid First Name
	 * @var string $VALID_FIRST_NAME
	 */
	protected $VALID_FIRST_NAME = "MIKE";


	/**
	 * valid Last Name
	 * @var string $VALID_LAST_NAME
	 */
	protected $VALID_LAST_NAME = "TYSON";


	/**
	 * valid phone number
	 * @var string $VALID_PHONE
	 */
	protected $VALID_PHONE = "5053214567";



	/**
	 * set up for valid organization and volunteer
	 */
	public final function setUp() {
		//run default setUp() method first
		parent::setUp();

		//create a salt and hash for test
		$salt= bin2hex(openssl_random_pseudo_bytes(32));
		$hash= $hash = hash_pbkdf2("sha512", "password4321", $salt, 262144, 128);

		//create a valid organization to reference in test
		$this->organization = new Organization(null, "23 Star Trek Rd", "Suit 2", "Bloomington", "Coffee, black", "24/7", "Enterprise", "5051234567", "NM", "G", "87106" );
		$this->organization->insert($this->getPDO());

		//create a valid Volunteer to reference in test
		$this->volunteer = new Volunteer(null, $this->organization->getOrgId(), "adminEmail@email.com", "1234567898765432", "firstName", $hash, "lastName", "5051234567", $salt);
		$this->volunteer->insert($this->getPDO());
	}


	/**
	 * test inserting a valid Administrator and verify that the actual mySQL data matches
	 */
	public function testInsertValidAdministrator() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("administrator");

		//create a new administrator and insert into mySQL
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO() );

		//grab data from SQL and esure it matches.
		$pdoAdministrator = Administrator::getAdministratorByAdminId($this->getPDO(), $administrator->getAdminId() );
		$this->assertSame($numRows + 1, $this->getConnection() ->getRowCount("administrator"));
		$this->assertSame($pdoAdministrator->getVolId(),$this->volunteer->getVolId() );
		$this->assertSame($pdoAdministrator->getorgId(),$this->organization->getOrgId() );
		$this->assertSame($pdoAdministrator->getAdminEmail(),$this->VALID_EMAIL);
		$this->assertSame($pdoAdministrator->getAdminEmailActivation(),$this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoAdministrator->getAdminFirstName(),$this->VALID_FIRST_NAME);
		$this->assertSame($pdoAdministrator->getAdminLastName(),$this->VALID_LAST_NAME);
		$this->assertSame($pdoAdministrator->getAdminPhone(),$this->VALID_PHONE);
	}

	/**
	 * test inserting a Administrator that already exists
	 *
	 * @expectedException PDOException
	 */
	public function testInsertInvalidAdministrator() {
		//create a administrator with a non null adminId and watch it fail.
		$administrator = new Administrator(BreadBasketTest::INVALID_KEY, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());
	}

	/**
	 * test inserting Administrator, editing it, and then updating it
	 */
	public function testUpdateValidAdministrator() {
		//count the nu,ber of rows and save it for later.
		$numRows = $this->getConnection()->getRowCount("administrator");

		//create a new Administrator and insert in into mySQL
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());

		//Edit the Administrator and update it in mySQL
		$administrator->setAdminEmail($this->VALID_EMAIL_ALT);
		$administrator->update($this->getPDO());

		//grab data from SQL and esure it matches.
		$pdoAdministrator = Administrator::getAdministratorByAdminId($this->getPDO(), $administrator->getAdminId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("administrator"));
		$this->assertSame($pdoAdministrator->getVolId(), $this->volunteer->getVolId());
		$this->assertSame($pdoAdministrator->getorgId(), $this->organization->getOrgId());
		$this->assertSame($pdoAdministrator->getAdminEmail(), $this->VALID_EMAIL_ALT);
		$this->assertSame($pdoAdministrator->getAdminEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoAdministrator->getAdminFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoAdministrator->getAdminLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoAdministrator->getAdminPhone(), $this->VALID_PHONE);
	}


	/**
	 * test updating a Administrator that does not exist
	 *
	 * @expectedExceptions PDOException
	 */
	public function testUpdateInvalidAdministrator() {
		//creata a Administrator and try to update it without actually inserting it.
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());
	}

	/**
	 * test creating a administrator and then deleting it
	 */
	public function testDeleteValidAdministrator() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("administrator");

		//create a new administrator adn insert to into mySQL
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());

		//delete the administrator from mySQL
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("administrator"));
		$administrator->delete($this->getPDO());

		//grab the data from mySQL and enforce the Administrator does not exist
		$pdoAdministrator = Administrator::getAdministratorByAdminId($this->getPDO(), $administrator->getAdminId());
		$this->assertNull($pdoAdministrator);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("administrator"));
	}

	/**
	 * test deleting a administrator that does not exist
	 *
	 * @expectedException PDOException
	 *
	 */
	public function testDeleteInvalidAdminId() {
		//create a administrator and try to delete it without actually inserting it
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());
	}

	/**
	 * test inserting a administrator and re-grabbing it from mySQL
	 */
	public function testGetValidAdministratorByAdminId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("administrator");

		//create a new Administrator and insert to inot mySQL
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations
		$pdoAdministrator = Administrator::getAdministratorByAdminId($this->getPDO(), $administrator->getAdminId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("administrator"));
		$this->assertSame($pdoAdministrator->getVolId(), $this->volunteer->getVolId());
		$this->assertSame($pdoAdministrator->getorgId(), $this->organization->getOrgId());
		$this->assertSame($pdoAdministrator->getAdminEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoAdministrator->getAdminEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoAdministrator->getAdminFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoAdministrator->getAdminLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoAdministrator->getAdminPhone(), $this->VALID_PHONE);
	}

	/**
	 * test grabbing a administrator that does not exist
	 */
	public function testGetInvalidAdminstratorByAdminId(){
		//grab a administrator id that exceeds the maximum allowable administrator id
		$administrator = Administrator::getAdministratorByAdminId($this->getPDO(), BreadBasketTest::INVALID_KEY);
		$this->assertNull($administrator);
	}

	/**
	 *test grabbing a administrator by vol Id
	 */
	public function testGetValidAdministratorByVolId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("administrator");

		//create a new Administrator and insert to inot mySQL
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations

		$pdoAdministrator = Administrator::getAdministratorByVolId($this->getPDO(), $administrator->getVolId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("administrator"));
		$this->assertSame($pdoAdministrator[0]->getVolId(), $this->volunteer->getVolId());
		$this->assertSame($pdoAdministrator[0]->getorgId(), $this->organization->getOrgId());
		$this->assertSame($pdoAdministrator[0]->getAdminEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoAdministrator[0]->getAdminEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoAdministrator[0]->getAdminFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoAdministrator[0]->getAdminLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoAdministrator[0]->getAdminPhone(), $this->VALID_PHONE);
	}

	/**
	 * test grabbing a Administrator by an vol id that does not exist
	 */
	public function testGetInvalidAdministratorByVolId() {
		//grab an organization that does not exist
		$administrator = Administrator::getAdministratorByVolId($this->getPDO(), "10000000000000000");
		$this->assertSame($administrator->getSize(), 0);
	}


	/**
	 *test grabbing a administrator by org Id
	 */
	public function testGetValidAdministratorByOrgId() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("administrator");

		//create a new Administrator and insert to inot mySQL
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations

		$pdoAdministrator = Administrator::getAdministratorByOrgId($this->getPDO(), $administrator->getOrgId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("administrator"));
		$this->assertSame($pdoAdministrator[0]->getVolId(), $this->volunteer->getVolId());
		$this->assertSame($pdoAdministrator[0]->getorgId(), $this->organization->getOrgId());
		$this->assertSame($pdoAdministrator[0]->getAdminEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoAdministrator[0]->getAdminEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoAdministrator[0]->getAdminFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoAdministrator[0]->getAdminLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoAdministrator[0]->getAdminPhone(), $this->VALID_PHONE);
	}

	/**
	 * test grabbing a Administrator by an org id that does not exist
	 */
	public function testGetInvalidAdministratorByOrgId() {
		//grab an organization that does not exist
		$administrator = Administrator::getAdministratorByOrgId($this->getPDO(), "10000000000000000");
		$this->assertSame($administrator->getSize(), 0);
	}


	/**
	 *test grabbing a administrator by adminEmail
	 */
	public function testGetValidAdministratorByAdminEmail() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("administrator");

		//create a new Administrator and insert to inot mySQL
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());

		//grab the data from mySQL and enforce the fields match our expectations

		$pdoAdministrator = Administrator::getAdministratorByAdminEmail($this->getPDO(), $administrator->getAdminEmail());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("administrator"));
		$this->assertSame($pdoAdministrator[0]->getVolId(), $this->volunteer->getVolId());
		$this->assertSame($pdoAdministrator[0]->getorgId(), $this->organization->getOrgId());
		$this->assertSame($pdoAdministrator[0]->getAdminEmail(), $this->VALID_EMAIL);
		$this->assertSame($pdoAdministrator[0]->getAdminEmailActivation(), $this->VALID_EMAIL_ACTIVATION);
		$this->assertSame($pdoAdministrator[0]->getAdminFirstName(), $this->VALID_FIRST_NAME);
		$this->assertSame($pdoAdministrator[0]->getAdminLastName(), $this->VALID_LAST_NAME);
		$this->assertSame($pdoAdministrator[0]->getAdminPhone(), $this->VALID_PHONE);
	}


	/**
	 * test grabbing a administrator by an email that does not exist
	 */
	public function testGetInvalidAdministratorByAdminEmail(){
		//grab an email that does not exist
		$administrator = Administrator::getAdministratorByAdminEmail($this->getPDO(), "invalidadmin@email.com");
		$this->assertSame($administrator->getSize(), 0);
	}



}



?>