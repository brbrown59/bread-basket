<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
/**
 * controller/api for the listing class
 *
 * @author Kimberly Keller keller.kimberly@gmail.com>
 */

//verify the xsrf challenge
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

//prepare an empty reply
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//create the Pusher connection
	$config = readConfig("/etc/apache2/capstone-mysql/breadbasket.ini");
	$pusherConfig = json_decode($config["pusher"]);
	$pusher = new Pusher($pusherConfig->key, $pusherConfig->secret, $pusherConfig->id, ["encrypted" => true]);

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//if the volunteer session is empty, the user is not logged in, throw an exception
	if(empty($_SESSION["volunteer"]) === true) {
		throw(new RuntimeException("Please log-in or sign up", 401));
	}

	//sanitize the id
	$id = filter_input(INPUT_GET, "id" FILTER_VALIDATE_INT);
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	//sanitize and trim the other fields
	$memo= filter_input(INPUT_GET, "memo", FILTER_SANITIZE_STRING);
	$cost = filter_input(INPUT_GET, "cost", FILTER_VALIDATE_FLOAT);
	$state = filter_input(INPUT_GET, "type", FILTER_VALIDATE_INT);

	//grab the mySQL connection
	$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/breadbasket.ini");

	//handle all RESTful calls to listing
	//get some or all Listings
	if($method === "GET") {
		//set an XSRF cookie on get requests
		setXsrfCookie("/");
		if(empty($id) === false) {
			$reply->data = Listing::getListingByListingId($pdo, $id);
		} elseif(empty($orgId)) {
			$reply->data = Listing::getListingByOrgId($pdo, $orgId);
		} elseif(empty($listingPostTime)) {
			$reply->data = Listing::getListingByListingPostTime($pdo, $listingPostTime);
		} elseif(empty($listing)) {
			$reply->data = Listing::getListingByParentId($pdo, $listingParentId);
		} elseif(empty($listingTypeId)) {
			$reply->data = Listing::getListingByTypeId($pdo, $listingTypeId);
		} else {
			$reply->data = Listing::getAllListings($pdo)->toArray();
		}



	}




	}

	//handle all RESTful calls to Listing
	//get some or all listings
}