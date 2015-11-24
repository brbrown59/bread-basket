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

class Message extends breadBasketTest {
	/**
	 * id for this message; this is the primary key
	 * @var int $messageId
	 **/
	private $messageId;
	/**
	 * id for listing; this is the a foreign key
	 * @var int $listingId
	 **/
	private $listingId;
	/**
	 * id of the organization (org) that listed the donation; this is a foreign key
	 * @var int $orgId
	 **/
	private $orgId;
	/**
	 * the content of the Message
	 * @var string $messageText
	 **/
	private $messageText;


	/**
	 *Setting up guzzel/cookies
	 */

	public function setUp() {
		parent::setUp();

		$this->guzzle = new \GuzzleHttp\Client(['cookies' => true]);

	}

	/**
	 * test deleting Valid Message
	 */
	public function testDeleteValidMessage(){
		//created a new message
		$newMessage = new Message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);
		$newMessage->insert($this->getPDO());

		//run a get request to establish session tokens
		$this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/');

		//grab the data from guzzle and enforce the status matches our exception
		$response = $this->guzzle->delete('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage->getMessage(), ['headers' => ['XRSF-TOKEN' => $this->getXsrfToken()]]);
		$this->assertSame($response-GetStatusCode(), 200);
		$body = $response->getBody();
		$alertLevel = jason_decode($body);
		$this->assertSame(200, $alertLevel->status);
	}

/*
 * test getting valid Message by messageId
 */

	public function testGetValidMessagebyMessageId(){
		//create a new message
		$newMessage =new message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);
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
	 $newMessage =new message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);
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
		$newMessage =new message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);
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
		$newMessage =new message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);
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
		$newMessage =new message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);
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
		$newMessage =new message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);
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
		$newMessage =new message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);
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
		$newMessage =new message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);
		$newMessage->insert($this->getPDO());

		//grab the data from guzzle
		$response = $this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api/message/' . $newMessage-getMessage());
		$this->assertSame($response->getStatusCode(),200);
		$body = $response->getBody();
		$alertLevel = json_decode ($body);
		$this->assertSame(200, $alertLevel->status);
	}

	/**
	 * test ability to Post Valid Message
	 */
	public function testPostValidMessage(){
		//create a new message
		$newMessage = new Message (null, $this->Valid_messageId, $this->VALID_listingId, $this->VALID_orgId, $this->VALID_messageText);

		//run a get request to establish session tokens
		$this->guzzle->get('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api');

		//Grab the Data from guzzle and enforce the status match our expectations
		$response = $this->guzzle->post('http://bootcamp-coders.cnm.edu/~bread-basket/public_html/php/api', ['headers' => ['X-XRF-TOKEN' => $this->getXsrfToken()], 'json' => $newMessage]);
		$this->assertSame($response->getStatusCode(), 200);
		$body = $response->getBody();
		$alertLevel = jason_decode($body);
		$this->assertSame(200, $alertLevel->status);
	}


}