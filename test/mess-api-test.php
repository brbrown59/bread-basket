<?php

//grab the project bread basket to test parameters
require_once("bread-basket.php");

//grab the autoloader for all COmposer classes
require_once(dirname(dirname(dirname(__DIR__))) . "/vendor/autoload.php");

//grab the class under scrutiny
require_once dirname(__DIR__) . "/public_html/php/classes/autoloader.php";

/**
 * PHPunit test for message API
 */

class MessageApiTest extends BreadBasketTest {
	/**
	 * id for this message; this is the primary key
	 * @var int $messageId
	 **/
	protected $VALID_MESSAGE_ID = "";
	/**
	 * id for listing; this is the a foreign key
	 * @var int $listingId
	 **/
	protected $VALID_LISTING_Id = "";
	/**
	 * id of the organization (org) that listed the donation; this is a foreign key
	 * @var int $orgId
	 **/
	protected $VALID_ORG_ID = "";
	/**
	 * the content of the Message
	 * @var string $messageText
	 **/
	protected $VALID_MESSAGE_TEXT = "";


	/**
	 *Setting up dependant objects before running each test
	 */

	public function setUp() {
		//run default set-up method
		parent::setUp();

		//create a new organization for the test message to belong
		$organization = new Message(null, "");
		$organization->insert($this->getPDO());

		//create a new volunteer for the test message to belong
		$volunteer =new Message(null, "");
		$volunteer->insert($this->getPDO());

		//create a new Listing type for the test message to belong
		$listingType = new Message(null, "");
		$listingType->insert($this->getPDO());

		//create a new listing type for the test message to belong
		$listing = new message(null. "");
		$listing->insert($this->getPDO());

		//create a new volunteer to use as an admin for the tests
		//dont need to insert them into database: just need their info to create sessions
		//for testing purposes, allow them to create organizations they not associated with
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash = hash_pbkdf2("userone", "passwordone", $salt, 262144, 128);
		$this->admin = new Volunteer(null, $organization->getOrgId(), "superfake@email.com", null, "Mike", $hash, true, "Smith", "505-321-1234", $salt);
		$this->admin->insert($this->getPDO());

		//create a non-admin voulunteer for the test
		$salt = bin2hex(openssl_random_pseudo_bytes(32));
		$hash = hash_pbkdf2("usertwo", "passwordtwo", $salt, 262144, 128);
		$this->volunteer = new Volunteer(null, $organization->getOrgId(), "superfake002@email.com", null, "Smithers", $hash, true, "Mikeson", "505-432-1234", $salt);
		$this->volunteer->insert($this->getPDO());


		// created guzzle client
		$this->guzzle = new \GuzzleHttp\Client(['cookies' => true]);

		//Visit ourselves to get the xsrf-token
		$this->guzzle=get('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/organization');
		$cookies = $this->guzzle->getConfig()["cookies"];
		$this->token =$cookies->getCookiesByname("XSRF-TOKEN")->getValue();

		//send a request to the sign-in-method

		$adminLogin = new stdClass();
		$adminLogin->email = "fakemail@sample.com";
		$adminLogin->password = "123password";
		$login = $this->guzzle->post('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/controlls/sign-in-controller.php', ['json' => $adminLogin, 'headers' => ['X-XSRF-TOKEN' => $this->token]]);

	}

	/**
	 * test deleting a Valid Message in the database
	 */
	public function testDeleteValidMessage(){
		//created a new message, and insert into the database
		$newMessage = new Message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//grab the data from guzzle and enforece that the status codes are correct
		$response = $this->guzzle->delete('http://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/message/' . $newMessage->getMessage(), ['headers' => ['XRSF-TOKEN' => $this->token]]);
		$this->assertSame($response-GetStatusCode(), 200);
		$body = $response->getBody();
		$retrievedMessage = json_decode($body);
		$this->assertSame(200, $retrievedMessage->status);

		//try retriving entry from database and ensuring it was deleted
		$deletedMess = Message::getMessageByMessageId($this->PDO(), $newMessage->getMessageId());
		$this->assertNull($deletedMess);
	}


	/**
	 * test deleting an object that does not exist
	 */
	public function testInvalidDelete() {
		$response =$this->guzzle->delete('http://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/message/' . BreadBasketTest::INVALID_KEY, ['headers' => ['XRSF-TOKEN' => $this->token]]);

		//make sure the request returns the proper error code for the failed operation
		$body =$response->getBody();
		$retrievedMess = json_encode($body);
		$this->assertSame(404, $retrievedMess->status);
	}


	/**
	 * test getting a valid object by ID
	 */
	public function testValidGetById() {
		//create a new message, and insert ino the database
		$newMessage = new Message(null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//send the get request to the API
		$response = $this->guzzle=get('http://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/message/' . $newMessage->getMessageId(), ['headers' => ['XRSF-TOKEN' => $this->token]]);

		//ensure the response was sent, and the api returned a positive status
		$this->assertSame($response->getStatusCode(), 200):
		$body = $response->getBody();
		$retrievedMass = json_encode($body);
		$this->AssertSame(200, $retrievedMass->status);

		//ensure the returned values meet expectations (just clicking enough to make sure the right thing was obtained)
		$this->assertSame($retrievedMass->data->messageId, $newMessage->getMessageId());
		$this->assertSame($retrievedMass->data->orgId, $this->VALID_ORG_ID);
	}


/*
 * test getting valid Message by messageId
 */
	public function testGetValidMessagebyMessageId(){
		//create a new message
		$newMessage =new message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//grab the data from guzzle
		$response = $this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage-getMessage());
		$this->assertSame($response->getStatusCode(),200);
		$body = $response->getBody();
		$alertLevel = json_decode ($body);
		$this->assertSame(200, $alertLevel->status);
	}


	/*
	 * test Getting invalid message by messageId
	 */
 Public function testGetInvalidMessageByMessageId(){
	 //create a new message
	 $newMessage =new message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
	 $newMessage->insert($this->getPDO());

	 //grab the data from guzzle
	 $response = $this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage-getMessage());
	 $this->assertSame($response->getStatusCode(),200);
	 $body = $response->getBody();
	 $alertLevel = json_decode ($body);
	 $this->assertSame(200, $alertLevel->status);
 }

	/*
	 * test Getting Valid message by Listing Id; listingId
	 */
	public function testGetValidMessageByListingId(){
		//create a new message
		$newMessage =new message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//grab the data from guzzle
		$response = $this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage-getMessage());
		$this->assertSame($response->getStatusCode(),200);
		$body = $response->getBody();
		$alertLevel = json_decode ($body);
		$this->assertSame(200, $alertLevel->status);
	}

/**
 *Test Getting Invalid Message by Listing Id; listingId
 */
	public function testGetInvalidMessageByListingId(){
		//create a new message
		$newMessage =new message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//grab the data from guzzle
		$response = $this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage-getMessage());
		$this->assertSame($response->getStatusCode(),200);
		$body = $response->getBody();
		$alertLevel = json_decode ($body);
		$this->assertSame(200, $alertLevel->status);
	}

	/*
 * test Getting Valid message by Organization Id; orgId
 */
	public function testGetValidMessageByOrgId(){
		//create a new message
		$newMessage =new message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//grab the data from guzzle
		$response = $this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage-getMessage());
		$this->assertSame($response->getStatusCode(),200);
		$body = $response->getBody();
		$alertLevel = json_decode ($body);
		$this->assertSame(200, $alertLevel->status);
	}

	/**
	 *Test Getting Invalid Message by Organization Id; orgId
	 */
	public function testGetInvalidMessageByOrgId(){
		//create a new message
		$newMessage =new message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//grab the data from guzzle
		$response = $this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage-getMessage());
		$this->assertSame($response->getStatusCode(),200);
		$body = $response->getBody();
		$alertLevel = json_decode ($body);
		$this->assertSame(200, $alertLevel->status);
	}

	/*
	 * Test Getting Valid message by Message Text; messageText
	 */
	public function testGetValidMessageByMessageText(){
		//create a new message
		$newMessage =new message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//grab the data from guzzle
		$response = $this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage-getMessage());
		$this->assertSame($response->getStatusCode(),200);
		$body = $response->getBody();
		$alertLevel = json_decode ($body);
		$this->assertSame(200, $alertLevel->status);
	}

	/**
	 *Test Getting Invalid Message by Message Text; messageText
	 */
	public function testGetInvalidMessageByMessageText(){
		//create a new message
		$newMessage =new message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//grab the data from guzzle
		$response = $this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage-getMessage());
		$this->assertSame($response->getStatusCode(),200);
		$body = $response->getBody();
		$alertLevel = json_decode ($body);
		$this->assertSame(200, $alertLevel->status);
	}

	/**
	 * test posting a valid message to the API
	 */
	public function testPostValidMessage(){
		//get the count of the numbers of rows in the database
		$numRows = $this->getConnection()->getRowCount("message");

		//create a new message to send
		$newMessage = new Message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);

		//run a get request to establish session tokens
		$this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/');

		//Grab the Data from guzzle and enforce the status match our expectations
		$response = $this->guzzle->post('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/', ['headers' => ['X-XRF-TOKEN' => $this->getXsrfToken()], 'json' => $newMessage]);
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$alertLevel = jason_decode($body);
		$this->assertSame(200, $alertLevel->status);

		//ensure a new row was added to the database
		$this->assertSame($numRows + 1, $this->getConnection()->getRowCount("message"));
	}

	/**
	 * test posting an invalid Message to the API
	 */
	public function testPostInvalidMessage(){
		//test to make sure non-admin can not post
		//sign out as admin, log-in as a voulenteer
		$logout = $this->guzzle-get('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/controllers/sign-out-controller.php');

		$volLogin = new stdClass();
		$volLogin->email = "samplemail@notreal.com";
		$volLogin->password = "passwordabc";
		$login = $this->guzzle->post('https://bootcamp-coders.cnm,edu/~cberaun2/bread-basket/public_html/php/controllers/sign-out-controller.php', ['allow_redirects' => ['strict' => true], 'json' => $volLogin, 'headers' => ['X-XSRF_TOKEN' => $this->token]]);

		$message = new Message(null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$response = $this->guzzle->post('https://bootcamp-coders.cnm,edu/~cberaun2/bread-basket/public_html/php/api/message', ['allow_redirects' => ['strict' => true], 'json' => $volLogin, 'headers' => ['X-XSRF_TOKEN' => $this->token]]);

		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$retrievedMess = json_decode($body);

		//Make sure the organization was not entered into the databaase
		$shouldNotExist = Message::getMessageByMessageId($this->getPDO(), $this->VALID_MESSAGE_ID);
		$this->assertSame($shouldNotExist->getSize(), 0);

		//makeSure 401 error is returned for trying to access an admin method as a volunteer
		$this->asserSame(401, $retrievedMess->status);
	}


	/**
	 * test putting a valid message into the API
	 */





	/*
	 * test putting an invalidid message ino the API
	 */
	public function testPutValidMessage () {

		//create a new message
		$newMessage = new Message (null, $this->VALID_MESSAGE_ID, $this->VALID_LISTING_Id, $this->VALID_ORG_ID, $this->VALID_MESSAGE_ID, $this->VALID_MESSAGE_TEXT);
		$newMessage->insert($this->getPDO());

		//run a get request to establish session tokens
		$this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/');

		//grab the data from guzzle and enforce the status match our expectations
		$response = $this->guzzle->put('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage->getMessage(),['headers' => ['X-XRF-TOKEN' => $this->getXsrfToken()], 'json' => $newMessage] );
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBpdy();
		$alertLevel = json_decode($body);
		$this->assertSame(200, $alertLevel->status);

	}

}