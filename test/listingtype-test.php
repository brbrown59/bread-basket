<?php
//grab the test parameters
require_once("bread-basket.php");

//grab the class to test
require_once(dirname(__DIR__) . "/public_html/php/classes/listingtype.php");

/**
 * Full PHPUnit test for the Organization class
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
	 * test inserting a valid type and verifying that the mySQL data matches
	*/
	public function testInsertValidListingType() {
		//count the rows in the database
		$numRows = $this->getConnection()->getRowCount("listingtype");
		$listingtype = new ListingType(null, $this->VALID_TYPE);

		//grab data from SQL and ensure it matches
		$pdoListingType = ListingType::getListingTypeById($this->getPDO(), $listingtype->getListingTypeId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listingtype"));
		$this->assertSame($pdoListingType->getListingTypeInfo(), $this->VALID_TYPE);
	}
}