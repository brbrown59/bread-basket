<?php
//grab the test parameters
require_once("bread-basket.php");
require_once("../public_html/php/classes/organization.php");


//grab the class to test
require_once(dirname(__DIR__) . "/public_html/php/classes/listing.php");
require_once(dirname(__DIR__) . "/public_html/php/traits/date-parsing-trait.php");

/**
 * Full PHPUnit test for the Message class
 *
 * This is a complete PHPUnit test of the message class.  It is complete because *all* mySQL/PDO enabled methods are tested
 * for both valid and invalid inputs
 *
 * @see Message
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 **/
class MessageTest extends BreadBasketTest {
	/**
	 * valid message id to use
	 * @var Int $VALID_MESSAGE_ID
	 **/
	protected $VALID_MESSAGE_ID = 123459;
	/**
	 * valid listing Id by to use
	 * @var Int $VALID_LISTING_ID = $this->listing->getListingId()
	 **/
	protected $listing = null;
	/**
	 * valid org Id by to use
	 * @var Int $VALID_ORGID = $this->organization->getOrgId
	 **/
	protected $organization = null;
	/**
	 * valid message text
	 * @var String $VALID_MESSAGE_TEXT
	 **/
	protected $VALID_MESSAGE_TEXT = "We have lots of tomatoes. Come and get them";
	/**
	 * valid message text
	 * @var String $VALID_MESSAGE_TEXT_2
	 **/
	protected $VALID_MESSAGE_TEXT_2 = "Come and get 'em";

	/**
	 * set up for valid organization
	 */
	public final function setUp() {
		//run default setUp() method first
		parent::setUp();

		//create a valid organization to reference in test
		$this->organization = new Organization(null, "89 Spring", "Suit 2", "ABQ", "Home2", "24/7", "2", "5051234567", "NM", "G", "87106" );
		$this->organization->insert($this->getPDO());
		//create a valid Listing Id to reference in test
		$this->listing = new Listing(null, 52, 33, true, 23.00, "We have apples", 102, "2012-07-08 11:14:15","B");
		$this->listing->insert($this->getPDO());
	}

	/**
	 * test inserting a valid message and verify that the actual mySQL data matches
	 **/
	public function testInsertValidMessage() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("message");


		//create a new message and insert into mySQL
		$message = new Message(null, $this->listing->getListingId(), $this->organization->getOrgId(), $this->VALID_MESSAGE_TEXT);
		$message->insert($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoMessage = Message::getMessageByMessageId($this->getPDO(), $message->getMessageId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("message"));
		$this->assertSame($pdoMessage->getListingId(), $this->listing->getListingId());
		$this->assertSame($pdoMessage->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoMessage->getMessageText(), $this->VALID_MESSAGE_TEXT);
	}

	/**
	 * test inserting a message that cannot be added
	 *
	 * @expectedException PDOException
	 */
	public function testInsertInvalidMessage() {
		//create message with non-null id, and hope it fails
		$message = new Message(BreadBasketTest::INVALID_KEY, $this->listing->getListingId(), $this->organization->getOrgId(), $this->VALID_MESSAGE_TEXT);
		$message->insert($this->getPDO());
	}

	public function testUpdateValidMessage() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("message");

		//create a new message and insert into mySQL
		$message = new Message(null, $this->listing->getListingId(), $this->organization->getOrgId(), $this->VALID_MESSAGE_TEXT);
		$message->insert($this->getPDO());

		//edit the message and update in mySQL
		$message->setMessageText($this->VALID_MESSAGE_TEXT_2);
		$message->update($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoMessage = Message::getMessageByMessageId($this->getPDO(), $message->getMessageId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("message"));
		$this->assertSame($pdoMessage->getListingId(), $this->listing->getListingId());
		$this->assertSame($pdoMessage->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoMessage->getMessageText(), $this->VALID_MESSAGE_TEXT2);
	}

	/**
	 * test updating a message that does not exist
	 *
	 * @expectedException PDOException
	 */
	public function testUpdateInvalidMessage() {
		//create message with non-null id, and hope it fails
		$message = new Message(null, $this->listing->getListingId(), $this->organization->getOrgId(), $this->VALID_MESSAGE_TEXT);
		$message->insert($this->getPDO());
	}

	public function testDeleteValidMessage() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("message");

		//create a new message and insert into mySQL
		$message = new Message(null, $this->listing->getListingId(), $this->organization->getOrgId(), $this->VALID_MESSAGE_TEXT);
		$message->insert($this->getPDO());

		//delete the message in mySQL
		$message->delete($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoMessage = Message::getMessageByMessageId($this->getPDO(), $message->getMessageId());
		$this->assertNull($pdoMessage);
		$this->assertSame($numRows, $this->getConnection()->getRowCount("message"));
	}

	/**
	 * test deleting a message that does not exist
	 *
	 * @expectedException PDOException
	 */
	public function testDeleteInvalidMessage() {
			//create message with non-null id, and hope it fails
			$message = new Message(null, $this->listing->getListingId(), $this->organization->getOrgId(), $this->VALID_MESSAGE_TEXT);
			$message->insert($this->getPDO());
		}
	/**
	 * test inserting a message and regrabbing it from mySQL
	 */
	public function testGetValidMessageByMessageId() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("message");

		//create a new message and insert into mySQL
		$message = new Message(null, $this->listing->getListingId(), $this->organization->getOrgId(), $this->VALID_MESSAGE_TEXT);
		$message->insert($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoMessage = Message::getMessageByMessageId($this->getPDO(), $message->getMessageId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("message"));
		$this->assertSame($pdoMessage->getListingId(), $this->listing->getListingId());
		$this->assertSame($pdoMessage->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoMessage->getMessageText(), $this->VALID_MESSAGE_TEXT);
	}

	/**
	 * test getting an organization by listing id that doesn't exist
	 */
	public function testGetInvalidListingByListingId() {
		$listing = Listing::getListingByListingId($this->getPDO(), BreadBasketTest::INVALID_KEY);
		$this->assertNull($listing);
	}

	public function testGetValidListingByOrgId() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("listing");

		//create a new listing and insert into mySQL
		$listing = new Listing(null, $this->organization->getOrgId(), $this->VALID_CLAIMEDBY, $this->VALID_LISTINGCLOSED, $this->VALID_COST, $this->VALID_MEMO, $this->VALID_PARENT_ID, $this->valid_datetime, $this->listingType->getListingTypeId());
		$listing->insert($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoListing = Listing::getListingByOrgId($this->getPDO(), $listing->getOrgId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listing"));
		$this->assertSame($pdoListing[0]->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoListing[0]->getListingClaimedBy(), $this->VALID_CLAIMEDBY);
		$this->assertSame($pdoListing[0]->getListingClosed(), $this->VALID_LISTINGCLOSED);
		$this->assertSame($pdoListing[0]->getListingCost(), $this->VALID_COST);
		$this->assertSame($pdoListing[0]->getListingMemo(), $this->VALID_MEMO);
		$this->assertSame($pdoListing[0]->getListingParentId(), $this->VALID_PARENT_ID);
		$this->assertEquals($pdoListing[0]->getListingPostTime(), $this->valid_datetime);
		$this->assertSame($pdoListing[0]->getListingTypeId(), $this->listingType->getlistingTypeId());
	}

	/**
	 * test for grabbing a listing by an orgid that doesn't exist
	 */
	public function testGetInvalidListingByOrgId() {
		$listing = Listing::getListingByOrgId($this->getPDO(), 1);
		$this->assertSame($listing->getSize(), 0);
	}

	/**test for grabbing a listing by parentid
	 *
	 */
	public function testGetValidListingByParentId() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("listing");

		//create a new listing and insert into mySQL
		$listing = new Listing(null, $this->organization->getOrgId(), $this->VALID_CLAIMEDBY, $this->VALID_LISTINGCLOSED, $this->VALID_COST, $this->VALID_MEMO,
			$this->VALID_PARENT_ID, $this->valid_datetime, $this->listingType->getlistingTypeId());
		$listing->insert($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoListing = Listing::getListingByParentId($this->getPDO(), $this->VALID_PARENT_ID);
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listing"));
		$this->assertSame($pdoListing[0]->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoListing[0]->getListingClaimedBy(), $this->VALID_CLAIMEDBY);
		$this->assertSame($pdoListing[0]->getListingClosed(), $this->VALID_LISTINGCLOSED);
		$this->assertSame($pdoListing[0]->getListingCost(), $this->VALID_COST);
		$this->assertSame($pdoListing[0]->getListingMemo(), $this->VALID_MEMO);
		$this->assertSame($pdoListing[0]->getListingParentId(), $this->VALID_PARENT_ID);
		$this->assertEquals($pdoListing[0]->getListingPostTime(), $this->valid_datetime);
		$this->assertSame($pdoListing[0]->getListingTypeId(), $this->listingType->getlistingTypeId());
	}

	/**
	 * test for grabbing a listing by a parent id that doesn't exist
	 */
	public function testGetInvalidListingParentId() {
		$listing = Listing::getListingByParentId($this->getPDO(), 1000001);
		$this->assertSame($listing->getSize(), 0);
	}


	/**test for grabbing a listing by listingPostTime
	 *
	 */
	public function testGetValidListingByListingPostTime() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("listing");

		//create a new listing and insert into mySQL
		$listing = new Listing(null, $this->organization->getOrgId(), $this->VALID_CLAIMEDBY, $this->VALID_LISTINGCLOSED, $this->VALID_COST, $this->VALID_MEMO,
			$this->VALID_PARENT_ID, $this->valid_datetime, $this->listingType->getlistingTypeId());
		$listing->insert($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoListing = Listing::getListingByListingPostTime($this->getPDO(), $this->valid_datetime);
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listing"));
		$this->assertSame($pdoListing[0]->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoListing[0]->getListingClaimedBy(), $this->VALID_CLAIMEDBY);
		$this->assertSame($pdoListing[0]->getListingClosed(), $this->VALID_LISTINGCLOSED);
		$this->assertSame($pdoListing[0]->getListingCost(), $this->VALID_COST);
		$this->assertSame($pdoListing[0]->getListingMemo(), $this->VALID_MEMO);
		$this->assertSame($pdoListing[0]->getListingParentId(), $this->VALID_PARENT_ID);
		//Changed to assertEquals because this is an object and assertSame checks an object position in memory
		$this->assertEquals($pdoListing[0]->getListingPostTime(), $this->valid_datetime);
		$this->assertSame($pdoListing[0]->getListingTypeId(), $this->listingType->getlistingTypeId());
	}

	/**
	 * test for grabbing a listing by a listing post time that doesn't exist
	 */
	public function testGetInvalidListingPostTime() {
		$listing = Listing::getListingByListingPostTime($this->getPDO(), $this->valid_datetime);
		$this->assertEquals($listing->getSize(), 0);
	}


	/**
	 * test for grabbing a listing by listing Type Id
	 *
	 */
	public function testGetValidListingByListingTypeId() {
		//get the count of the number of rows in the database
		$numRows = $this->getConnection()->getRowCount("listing");

		//create a new listing and insert into mySQL
		$listing = new Listing(null, $this->organization->getOrgId(), $this->VALID_CLAIMEDBY, $this->VALID_LISTINGCLOSED, $this->VALID_COST, $this->VALID_MEMO,
			$this->VALID_PARENT_ID, $this->valid_datetime, $this->listingType->getlistingTypeId());
		$listing->insert($this->getPDO());

		//grab data from SQL and ensure it matches
		$pdoListing = Listing::getListingByTypeId($this->getPDO(), $this->listingType->getlistingTypeId());
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("listing"));
		$this->assertSame($pdoListing[0]->getOrgId(), $this->organization->getOrgId());
		$this->assertSame($pdoListing[0]->getListingClaimedBy(), $this->VALID_CLAIMEDBY);
		$this->assertSame($pdoListing[0]->getListingClosed(), $this->VALID_LISTINGCLOSED);
		$this->assertSame($pdoListing[0]->getListingCost(), $this->VALID_COST);
		$this->assertSame($pdoListing[0]->getListingMemo(), $this->VALID_MEMO);
		$this->assertSame($pdoListing[0]->getListingParentId(), $this->VALID_PARENT_ID);
		$this->assertEquals($pdoListing[0]->getListingPostTime(), $this->valid_datetime);
		$this->assertSame($pdoListing[0]->getListingTypeId(), $this->listingType->getlistingTypeId());
	}

	/**
	 * test for grabbing a listing by a listing Type Id that doesn't exist
	 */
	public function testGetInvalidListingTypeId() {
		$listing = Listing::getListingByTypeId($this->getPDO(), 1);
		$this->assertSame($listing->getSize(), 0);
	}

}