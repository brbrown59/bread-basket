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
	protected $VALID_DESCRIPTION = "Providing food to Albuquerque's most in-need citizens";
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
		$this->assertSame($pdoOrganization->getAddress1(), $this->VALID_ADDRESS1);
		$this->assertSame($pdoOrganization->getAddress2(), $this->VALID_ADDRESS2);
		$this->assertSame($pdoOrganization->getCity(), $this->VALID_CITY);
		$this->assertSame($pdoOrganization->getDescription(), $this->VALID_DESCRIPTION);
		$this->assertSame($pdoOrganization->getHours(), $this->VALID_HOURS);
		$this->assertSame($pdoOrganization->getName(), $this->VALID_NAME);
		$this->assertSame($pdoOrganization->getPhone(), $this->VALID_PHONE);
		$this->assertSame($pdoOrganization->getState(), $this->VALID_STATE);
		$this->assertSame($pdoOrganization->getType(), $this->VALID_TYPE);
		$this->assertSame($pdoOrganization->getZip(), $this->VALID_ZIP);
	}
}