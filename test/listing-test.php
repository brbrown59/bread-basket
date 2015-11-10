<?php
//grab the test parameters
require_once("bread-basket.php");

//grab the class to test
require_once(dirname(__DIR__) . "/public_html/php/classes/listing.php");

/**
 * Full PHPUnit test for the Listing class
 *
 * This is a complete PHPUnit test of the listing class.  it is complete because *all* mySQL/PDO enabled methods are tested
 * for both valid and invalid inputs
 *
 * @see Listing
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 **/
class ListingTest extends BreadBasketTest {
	/**
	 * valid org Id by to use
	 * @var Int $VALID_ORGID
	 **/
	protected $VALID_ORGID = "123459";
	/**
	 * valid listing claimed by to use
	 * @var Int $VALID_CLAIMEDBY
	 **/
	protected $VALID_CLAIMEDBY = "123459";
	/**
	 * valid listing closed
	 * @var Bool $VALID_LISTINGCLOSED
	 **/
	protected $VALID_LISTINGCLOSED = TRUE;
	/**
	 * valid listing cost
	 * @var Double $VALID_COST
	 **/
	protected $VALID_COST = 94.25;
	/**
	 * valid listing memo
	 * @var String $VALID_MEMO
	 **/
	protected $VALID_MEMO = "We have lots of tomatoes. Come and get them";
	/**
	 * valid parentId
	 * @var Int $VALID_PARENT_ID
	 */
	protected $VALID_PARENT_ID = "5554268";
/**
 * valid listingPostTime
 * @var DATETIME $VALID_DATETIME
 **/
	protected $VALID_DATETIME = "20115-02-15 18:25:00";
	/**
	 * valid listing type to use
	 * @var Int $VALID_TYPE
	 **/
	protected $VALID_TYPE = "3";
	/**
	 * test inserting a valid listing and verify that the actual mySQL data matches
	 **/
	public function testInsertValidListing() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("listing");

	//create a new listing and insert into mySQL
$listing = new Listing(null, $this->VALID_ORGID, $this->VALID_CLAIMEDBY, $this->VALID_LISTINGCLOSED, $this->VALID_COST, $this->VALID_MEMO,
$this->VALID_PARENT_ID, $this->VALID_DATETIME, $this->VALID_TYPE);
$listing->insert($this->getPDO());

	//grab data from SQL and ensure it matches
$pdoListing = Listing::getListingByListingId($this->getPDO(), $listing->getListingId());
$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listing"));
$this->assertSame($pdoListing->getOrgId(), $this->VALID_ORGID);
$this->assertSame($pdoListing->getListingClaimedBy(), $this->VALID_CLAIMEDBY);
$this->assertSame($pdoListing->getListingClosed(), $this->VALID_LISTINGCLOSED);
$this->assertSame($pdoListing->getListingCost(), $this->VALID_COST);
$this->assertSame($pdoListing->getListingMemo(), $this->VALID_MEMO);
$this->assertSame($pdoListing->getParentId(), $this->VALID_PARENT_ID);
$this->assertSame($pdoListing->getListingPostTime(), $this->VALID_DATETIME);
$this->assertSame($pdoListing->getListingTypeId(), $this->VALID_TYPE);
}
}