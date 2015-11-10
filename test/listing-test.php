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
	protected $VALID_COST = 2594.259960;
	/**
	 * valid listing memo
	 * @var String $VALID_MEMO
	 **/
	protected $VALID_DESCRIPTION = "We have lots of tomatoes. Come and get them";
	/**
	 * valid parentId
	 * @var Int $VALID_PARENT_ID
	 */
	protected $VALID_PRARENT_ID = "5554268";
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
		$numRows = $this->getConnection()
	}

}