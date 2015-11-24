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






}