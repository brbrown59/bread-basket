<?php
//grab the test parameters
require_once("bread-basket.php");

//grab the class to test
require_once(dirname(__DIR__) . "/public_html/php/classes/listingtype.php");

/**
 * Full PHPUnit test for the ListingType class
 *
 * This is a complete PHPUnit test of the listing type class.  it is complete because *all* mySQL/PDO enabled methods are tested
 * for both valid and invalid inputs
 *
 * @see ListingType
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 **/
class ListingTypeTest extends BreadBasketTest {
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
	 * test inserting a valid type and verifying that the mySQL data matches
	*/
	public function testInsertValidListingType() {
		//count the rows in the database
		$numRows = $this->getConnection()->getRowCount("listingType");

		$listingtype = new ListingType(null, $this->VALID_TYPE);
		$listingtype->insert($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoListingType = ListingType::getListingTypeById($this->getPDO(), $listingtype->getListingTypeId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listingType"));
		$this->assertSame($pdoListingType->getListingTypeInfo(), $this->VALID_TYPE);
	}

	/**
	 * test deleting a valid type and verifying that the mySQL data matches
	 * @expectedException PDOException
	 */
	public function testInsertInvalidListingType() {
		$listingtype = new ListingType(BreadBasketTest::INVALID_KEY, $this->VALID_TYPE);
		$listingtype->insert($this->getPDO());
	}

	/**
	 * test updating a valid type and verifying that the mySQL data matches
	 */
	public function testUpdateValidListingType() {
		//count the rows in the database
		$numRows = $this->getConnection()->getRowCount("listingType");

		$listingtype = new ListingType(null, $this->VALID_TYPE);
		$listingtype->insert($this->getPDO());

		$listingtype->setListingTypeInfo(($this->VALID_TYPE_2));
		$listingtype->update($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoListingType = ListingType::getListingTypeById($this->getPDO(), $listingtype->getListingTypeId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listingType"));
		$this->assertSame($pdoListingType->getListingTypeInfo(), $this->VALID_TYPE_2);
	}

	/**
	 * test updating a listing type that does not exist
	 *
	 * @expectedException PDOException
	 */
	public function testUpdateInvalidListingType() {
		//create a listing type and update without inserting it
		$listingtype = new ListingType(BreadBasketTest::INVALID_KEY, $this->VALID_TYPE);
		$listingtype->update($this->getPDO());
	}

	/**
	 *
	 */
	public function testDeleteValidListingType() {
		//count the number of rows currently in the database
		$numRows = $this->getConnection()->getRowCount("listingType");

		//create the object and insert into mysql
		$listingtype = new ListingType(null, $this->VALID_TYPE);
		$listingtype->insert($this->getPDO());

		//confirm the row was added, then delete it
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listingType"));
		$listingtype->delete($this->getPDO());

		//grab data from mysql and ensure it doesn't exist
		$pdoListingType = ListingType::getListingTypeById($this->getPDO(), $listingtype->getListingTypeId());
		$this->assertNull($pdoListingType);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("listingType"));
	}

	/**
	 * test deleting an organization that does not exist
	 *
	 * @expectedException PDOException
	 */
	public function testDeleteInvalidListingType() {
		//create listingtype and delete without actually inserting it
		$listingtype = new ListingType(null, $this->VALID_TYPE);
		$listingtype->delete($this->getPDO());
	}

	/**
	 * test inserting an organization and regrabbing it from mySQL
	 */
	public function testGetValidListingTypeById() {
		//count the rows in the database
		$numRows = $this->getConnection()->getRowCount("listingType");

		$listingtype = new ListingType(null, $this->VALID_TYPE);
		$listingtype->insert($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoListingType = ListingType::getListingTypeById($this->getPDO(), $listingtype->getListingTypeId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listingType"));
		$this->assertSame($pdoListingType->getListingTypeInfo(), $this->VALID_TYPE);
	}
}