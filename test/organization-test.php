<?php
//grab the test parameters
require_once("bread-basket.php");

//grab the class to test
require_once(dirname(__DIR__) . "/public_html/php/classes/organization.php");

/**
 * Full PHPUnit test for the Organization class
 *
 * This is a complete PHPUnit test of the profile class.  it is complete because *all* mySQL/PDO enabled methods are tested
 * for both valid and invalid inputs
 *
 * @see Organization
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 **/
class OrganizationTest extends BreadBasketTest {
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
	protected $VALID_NAME = "Feeding Albuquerque";
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
	protected $VALID_TYPE = "F";
	/**
	 * valid organization zip code to use
	 * @var String $VALID_ZIP
	 */
	protected $VALID_ZIP = "87102";

	/**
	 * test inserting a valid organization and verify that the mySQL data matches
	 */
	public function testInsertValidOrganization() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoOrganization = Organization::getOrganizationByOrgId($this->getPDO(), $organization->getOrgId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
		$this->assertSame($pdoOrganization->getOrgAddress1(), $this->VALID_ADDRESS1);
		$this->assertSame($pdoOrganization->getOrgAddress2(), $this->VALID_ADDRESS2);
		$this->assertSame($pdoOrganization->getOrgCity(), $this->VALID_CITY);
		$this->assertSame($pdoOrganization->getOrgDescription(), $this->VALID_DESCRIPTION);
		$this->assertSame($pdoOrganization->getOrgHours(), $this->VALID_HOURS);
		$this->assertSame($pdoOrganization->getOrgName(), $this->VALID_NAME);
		$this->assertSame($pdoOrganization->getOrgPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoOrganization->getOrgState(), $this->VALID_STATE);
		$this->assertSame($pdoOrganization->getOrgType(), $this->VALID_TYPE);
		$this->assertSame($pdoOrganization->getOrgZip(), $this->VALID_ZIP);
	}

	/**
	 * test inserting an organization that cannot be added
	 * @expectedException PDOException
	 */
	public function testInsertInvalidOrganization() {
		//create organization with non-null id, and hope it fails
		$organization = new Organization(BreadBasketTest::INVALID_KEY, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());
	}

	/**
	 * test inserting an organization, editing it, then updating it
	 */
	public function testUpdateValidOrganization() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//edit the organization and update it in mySQL
		$organization->setOrgName($this->VALID_NAME_ALT);
		$organization->update($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoOrganization = Organization::getOrganizationByOrgId($this->getPDO(), $organization->getOrgId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
		$this->assertSame($pdoOrganization->getOrgAddress1(), $this->VALID_ADDRESS1);
		$this->assertSame($pdoOrganization->getOrgAddress2(), $this->VALID_ADDRESS2);
		$this->assertSame($pdoOrganization->getOrgCity(), $this->VALID_CITY);
		$this->assertSame($pdoOrganization->getOrgDescription(), $this->VALID_DESCRIPTION);
		$this->assertSame($pdoOrganization->getOrgHours(), $this->VALID_HOURS);
		$this->assertSame($pdoOrganization->getOrgName(), $this->VALID_NAME);
		$this->assertSame($pdoOrganization->getOrgPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoOrganization->getOrgState(), $this->VALID_STATE);
		$this->assertSame($pdoOrganization->getOrgType(), $this->VALID_TYPE);
		$this->assertSame($pdoOrganization->getOrgZip(), $this->VALID_ZIP);
	}

	/**
	 * test updating an organization that does not exist
	 *
	 * @expectedException PDOException
	 */
	public function testUpdateInvalidOrganization() {
		//create an organization and try to update without inserting first
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->update($this->getPDO());
	}

	/**
	 * test creating an organization and then deleting it
	 */
	public function testDeleteValidOrganization() {
		//count the number of rows currently in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//confirm the row was added, then delete it
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
		$organization->delete($this->getPDO());

		//grab data from mySQL and ensure it doesn't exist
		$pdoOrganization = Organization::getOrganizationByOrgId($this->getPDO(), $organization->getOrgID());
		$this->assertNull($pdoOrganization);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("organization"));
	}

	/**
	 * test deleting an organization that does not exist
	 *
	 * @expectedException PDOException
	 */
	public function testDeleteInvalidOrganization() {
		//create organization and delete without actually inserting it
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->delete($this->getPDO());
	}

	/**
	 * test inserting an organization and regrabbing it from mySQL
	 */
	public function testGetValidOrganizationByOrgId() {
		//count the number of rows currently in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//grab data from mySQL and enforce that the fields match
		$pdoOrganization = Organization::getOrganizationByOrgId($this->getPDO(), $organization->getOrgId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
		$this->assertSame($pdoOrganization->getOrgAddress1(), $this->VALID_ADDRESS1);
		$this->assertSame($pdoOrganization->getOrgAddress2(), $this->VALID_ADDRESS2);
		$this->assertSame($pdoOrganization->getOrgCity(), $this->VALID_CITY);
		$this->assertSame($pdoOrganization->getOrgDescription(), $this->VALID_DESCRIPTION);
		$this->assertSame($pdoOrganization->getOrgHours(), $this->VALID_HOURS);
		$this->assertSame($pdoOrganization->getOrgName(), $this->VALID_NAME);
		$this->assertSame($pdoOrganization->getOrgPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoOrganization->getOrgState(), $this->VALID_STATE);
		$this->assertSame($pdoOrganization->getOrgType(), $this->VALID_TYPE);
		$this->assertSame($pdoOrganization->getOrgZip(), $this->VALID_ZIP);
	}

	/**
	 * test getting an organization that does not exist
	 */
	public function testGetInvalidOrganizationByOrgId() {
		//grab an id that exceeds the maximum allowable value
		$organization = Organization::getOrganizationByOrgId($this->getPDO(), BreadBasketTest::INVALID_KEY);
		$this->assertNull($organization);
	}

	/**
	 * test grabbing an organization by city
	 */
	public function testGetValidOrganizationByCity() {
		//count the number of rows currently in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//grab data from mySQL and enforce that the fields match
		$pdoOrganization = Organization::getOrganizationByOrgCity($this->getPDO(), $this->VALID_CITY);
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
		$this->assertSame($pdoOrganization[0]->getOrgAddress1(), $this->VALID_ADDRESS1);
		$this->assertSame($pdoOrganization[0]->getOrgAddress2(), $this->VALID_ADDRESS2);
		$this->assertSame($pdoOrganization[0]->getOrgCity(), $this->VALID_CITY);
		$this->assertSame($pdoOrganization[0]->getOrgDescription(), $this->VALID_DESCRIPTION);
		$this->assertSame($pdoOrganization[0]->getOrgHours(), $this->VALID_HOURS);
		$this->assertSame($pdoOrganization[0]->getOrgName(), $this->VALID_NAME);
		$this->assertSame($pdoOrganization[0]->getOrgPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoOrganization[0]->getOrgState(), $this->VALID_STATE);
		$this->assertSame($pdoOrganization[0]->getOrgType(), $this->VALID_TYPE);
		$this->assertSame($pdoOrganization[0]->getOrgZip(), $this->VALID_ZIP);
	}
	/**
	 * test for grabbing an organization by city that does not exist
	 */
	public function testGetInvalidOrganizationByCity() {
		$organization = Organization::getOrganizationByOrgCity($this->getPDO(), "Atlantis");
		$this->assertNull($organization);
	}

	/**
	 * test grabbing an organization by Name
	 */
	public function testGetValidOrganizationByName() {
		//count the number of rows currently in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//grab data from mySQL and enforce that the fields match
		$pdoOrganization = Organization::getOrganizationByOrgName($this->getPDO(), $this->VALID_NAME);
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
		$this->assertSame($pdoOrganization[0]->getOrgAddress1(), $this->VALID_ADDRESS1);
		$this->assertSame($pdoOrganization[0]->getOrgAddress2(), $this->VALID_ADDRESS2);
		$this->assertSame($pdoOrganization[0]->getOrgCity(), $this->VALID_CITY);
		$this->assertSame($pdoOrganization[0]->getOrgDescription(), $this->VALID_DESCRIPTION);
		$this->assertSame($pdoOrganization[0]->getOrgHours(), $this->VALID_HOURS);
		$this->assertSame($pdoOrganization[0]->getOrgName(), $this->VALID_NAME);
		$this->assertSame($pdoOrganization[0]->getOrgPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoOrganization[0]->getOrgState(), $this->VALID_STATE);
		$this->assertSame($pdoOrganization[0]->getOrgType(), $this->VALID_TYPE);
		$this->assertSame($pdoOrganization[0]->getOrgZip(), $this->VALID_ZIP);
	}
	/**
	 * test for grabbing an organization by name that does not exist
	 */
	public function testGetInvalidOrganizationByName() {
		$organization = Organization::getOrganizationByOrgName($this->getPDO(), "Let the Poor Starve");
		$this->assertNull($organization);
	}

	/**
	 * test grabbing an organization by state
	 */
	public function testGetValidOrganizationByState() {
		//count the number of rows currently in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//grab data from mySQL and enforce that the fields match
		$pdoOrganization = Organization::getOrganizationByOrgState($this->getPDO(), $this->VALID_STATE);
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
		$this->assertSame($pdoOrganization[0]->getOrgAddress1(), $this->VALID_ADDRESS1);
		$this->assertSame($pdoOrganization[0]->getOrgAddress2(), $this->VALID_ADDRESS2);
		$this->assertSame($pdoOrganization[0]->getOrgCity(), $this->VALID_CITY);
		$this->assertSame($pdoOrganization[0]->getOrgDescription(), $this->VALID_DESCRIPTION);
		$this->assertSame($pdoOrganization[0]->getOrgHours(), $this->VALID_HOURS);
		$this->assertSame($pdoOrganization[0]->getOrgName(), $this->VALID_NAME);
		$this->assertSame($pdoOrganization[0]->getOrgPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoOrganization[0]->getOrgState(), $this->VALID_STATE);
		$this->assertSame($pdoOrganization[0]->getOrgType(), $this->VALID_TYPE);
		$this->assertSame($pdoOrganization[0]->getOrgZip(), $this->VALID_ZIP);
	}
	/**
	 * test for grabbing an organization by state that does not exist
	 */
	public function testGetInvalidOrganizationByState() {
		$organization = Organization::getOrganizationByOrgState($this->getPDO(), "ZQ");
		$this->assertNull($organization);
	}

	/**
	 * test grabbing an organization by type
	 */
	public function testGetValidOrganizationByType() {
		//count the number of rows currently in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//grab data from mySQL and enforce that the fields match
		$pdoOrganization = Organization::getOrganizationByOrgType($this->getPDO(), $this->VALID_TYPE);
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
		$this->assertSame($pdoOrganization[0]->getOrgAddress1(), $this->VALID_ADDRESS1);
		$this->assertSame($pdoOrganization[0]->getOrgAddress2(), $this->VALID_ADDRESS2);
		$this->assertSame($pdoOrganization[0]->getOrgCity(), $this->VALID_CITY);
		$this->assertSame($pdoOrganization[0]->getOrgDescription(), $this->VALID_DESCRIPTION);
		$this->assertSame($pdoOrganization[0]->getOrgHours(), $this->VALID_HOURS);
		$this->assertSame($pdoOrganization[0]->getOrgName(), $this->VALID_NAME);
		$this->assertSame($pdoOrganization[0]->getOrgPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoOrganization[0]->getOrgState(), $this->VALID_STATE);
		$this->assertSame($pdoOrganization[0]->getOrgType(), $this->VALID_TYPE);
		$this->assertSame($pdoOrganization[0]->getOrgZip(), $this->VALID_ZIP);
	}
	/**
	 * test for grabbing an organization by type that does not exist
	 */
	public function testGetInvalidOrganizationByType() {
		$organization = Organization::getOrganizationByOrgType($this->getPDO(), "Z");
		$this->assertNull($organization);
	}

	/**
	 * test grabbing an organization by zip code
	 */
	public function testGetValidOrganizationByZip() {
		//count the number of rows currently in the database
		$numRows = $this->getConnection()->getRowCount("organization");

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $this->VALID_ADDRESS1, $this->VALID_ADDRESS2, $this->VALID_CITY, $this->VALID_DESCRIPTION,
			$this->VALID_HOURS, $this->VALID_NAME, $this->VALID_PHONE, $this->VALID_STATE, $this->VALID_TYPE, $this->VALID_ZIP);
		$organization->insert($this->getPDO());

		//grab data from mySQL and enforce that the fields match
		$pdoOrganization = Organization::getOrganizationByOrgZip($this->getPDO(), $this->VALID_ZIP);
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("organization"));
		$this->assertSame($pdoOrganization[0]->getOrgAddress1(), $this->VALID_ADDRESS1);
		$this->assertSame($pdoOrganization[0]->getOrgAddress2(), $this->VALID_ADDRESS2);
		$this->assertSame($pdoOrganization[0]->getOrgCity(), $this->VALID_CITY);
		$this->assertSame($pdoOrganization[0]->getOrgDescription(), $this->VALID_DESCRIPTION);
		$this->assertSame($pdoOrganization[0]->getOrgHours(), $this->VALID_HOURS);
		$this->assertSame($pdoOrganization[0]->getOrgName(), $this->VALID_NAME);
		$this->assertSame($pdoOrganization[0]->getOrgPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoOrganization[0]->getOrgState(), $this->VALID_STATE);
		$this->assertSame($pdoOrganization[0]->getOrgType(), $this->VALID_TYPE);
		$this->assertSame($pdoOrganization[0]->getOrgZip(), $this->VALID_ZIP);
	}
	/**
	 * test for grabbing an organization by type that does not exist
	 */
	public function testGetInvalidOrganizationByZip() {
		$organization = Organization::getOrganizationByOrgZip($this->getPDO(), "99999");
		$this->assertNull($organization);
	}
}