<?php
/**
 * Created by PhpStorm.
 * User: CSB505
 * Date: 11/10/15
 * Time: 10:07 AM
 */

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
	 * set up for valid Administrator
	 */
	public final function setUP() {
		//run default setUp() method first
		parent::setUp();

		//create a valid Administrator to reference in test
		$this->administrator = new Administrator(null, "sample001", "sample002", "sample003", "sample004", "sample005", "sample006",  );
		$this->administrator->insert($this->getPDO());
	}

	/**
	 * test inserting a valid Administrator and verify that the actual mySQL data matches
	 */
	public function testInsertValidAdministrator() {
		//count the number of rows and save it for later
		$numRows = $this->getConnection()->getRowCount("administrator");

		//create a new administrator and insert into mySQL
		$administrator = new Administrator(null, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ALT, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO() );

		//grab data from SQL and esure it matches.
		$pdoAdministrator = Administrator::getAdministratorByAdminId($this->getPDO(), $administrator->getAdminId() );
		$this->assertsame($numRows + 1, $this->getConnection() ->getRowCount("administrator"));
		$this->assertsame($pdoAdministrator->getVolId(),$this->volunteer->getVolId() );
		$this->assertsame($pdoAdministrator->getorgId(),$this->organization->getOrgId() );
		$this->assertsame($pdoAdministrator->getAdminEmail(),$this->VALID_EMAIL);
		$this->assertsame($pdoAdministrator->getAdminEmailActivation(),$this->VALID_EMAIL_ACTIVATION);
		$this->assertsame($pdoAdministrator->getAdminFirstName(),$this->VALID_FIRST_NAME);
		$this->assertsame($pdoAdministrator->getAdminLastName(),$this->VALID_LAST_NAME);
		$this->assertsame($pdoAdministrator->getAdminPhone(),$this->VALID_PHONE);
	}

	/**
	 * test inserting a Administrator that already exists
	 *
	 * @expectedException PDOException
	 */
	public function testInsertInvalidAdministrator(){
		//create a administrator with a non null adminId and watch it fail.
		$administrator = new administrator(BreadBasketTest::INVALID_KEY, $this->volunteer->getVolId(), $this->organization->getOrgId(), $this->VALID_EMAIL, $this->VALID_EMAIL_ALT, $this->VALID_EMAIL_ACTIVATION, $this->VALID_FIRST_NAME, $this->VALID_LAST_NAME, $this->VALID_PHONE);
		$administrator->insert($this->getPDO());
	}

	/**
	 * test inserting a
	 */

}



?>