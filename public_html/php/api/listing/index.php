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
		setXsrfCookie("/");
		throw(new RuntimeException("Please log-in or sign up", 401));
	}

	//sanitize the id
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	//sanitize and trim the other fields
	$orgId = filter_input(INPUT_GET, "orgId", FILTER_VALIDATE_INT);
	$memo = filter_input(INPUT_GET, "memo", FILTER_SANITIZE_STRING);
	$cost = filter_input(INPUT_GET, "cost", FILTER_VALIDATE_FLOAT);
	$typeId = filter_input(INPUT_GET, "typeId", FILTER_VALIDATE_INT);
	$parentId = filter_input(INPUT_GET, "parentId", FILTER_VALIDATE_INT);
	$postTime = Listing::validateDate($postTime);

	//grab the mySQL connection
	$pdo = connectToEncryptedMySql("/etc/apache2/capstone-mysql/breadbasket.ini");

	//handle all RESTful calls to listing
	//get some or all Listings
	if($method === "GET") {
		//set an XSRF cookie on get requests
		setXsrfCookie("/");
		if(empty($id) === false) {
			$reply->data = Listing::getListingByListingId($pdo, $id);
		} elseif(empty($orgId) === false) {
			$reply->data = Listing::getListingByOrgId($pdo, $orgId);
		} elseif(empty($postTime) === false) {
			$reply->data = Listing::getListingByListingPostTime($pdo, $postTime)->toArray();
		} elseif(empty($parentId) === false) {
			$reply->data = Listing::getListingByParentId($pdo, $parentId)->toArray();
		} elseif(empty($typeId) === false) {
			$reply->data = Listing::getListingByTypeId($pdo, $typeId)->toArray();
		} else {
			$reply->data = Listing::getAllListings($pdo)->toArray();
		}
	}
	//verify admin and verify object not empty

	//if the session belongs to an admin, allow post, put, and delete methods
	if(empty($_SESSION["volunteer"]) === false && $_SESSION["volunteer"]->getVolIsAdmin() === true) {

		if($method === "PUT" || $method === "POST") {

			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//make sure all fields are present, in order to prevent database issues
			if(empty($requestObject->orgId) === true) {
				throw(new InvalidArgumentException ("organization id cannot be empty", 405));
			}
			if(empty($requestObject->listingClaimedBy) === true) {
				$requestObject->listingClaimedBy = null;
			}
			if(empty($requestObject->listingClosed) === true) {
				$requestObject->listingClosed = null;
			}
			if(empty($requestObject->listingCost) === true) {
				$requestObject->listingCost = null;
			}
			if(empty($requestObject->listingMemo) === true) {
				throw(new InvalidArgumentException("listing memo cannot be empty", 405));
			}
			if(empty($requestObject->listingParentId) === true) {
				$requestObject->listingParentId = null;
			}
			if(empty($requestObject->listingPostTime) === true) {
				throw(new InvalidArgumentException("listing post time cannot be empty", 405));
			}
			if(empty($requestObject->listingTypeId) === true) {
				throw(new InvalidArgumentException("listing type cannot be empty", 405));
			}

			//perform the actual put or post
			if($method === "PUT") {
				$listing = Listing::getListingByListingId($pdo, $id);
				if($listing === null) {
					throw(new RuntimeException("Listing does not exist", 404));
				}

				$listing = new Listing($id, $requestObject->orgId, $requestObject->listingClaimedBy, $requestObject->listingClosed,
					$requestObject->listingCost, $requestObject->listingMemo,$requestObject->listingParentId, $requestObject->listingPostTime, $requestObject->listingTypeId);
				$listing->update($pdo);
				$pusher->trigger("listing", "update", $listing);

				$reply->message = "Listing updated OK";

			} elseif($method === "POST") {
				$listing = new Listing(null, $requestObject->orgId, $requestObject->listingClaimedBy, $requestObject->listingClosed,
					$requestObject->listingCost, $requestObject->listingMemo,$requestObject->listingParentId, $requestObject->listingPostTime, $requestObject->listingTypeId);
				$listing->insert($pdo);
				$pusher->trigger("listing", "new", $listing);

				$reply->message = "Listing created OK";

			}

		} elseif($method === "DELETE") {
			$listing = Listing::getListingByListingId($pdo, $id);
			if($listing === null) {
				throw(new RuntimeException("Listing does not exist", 404));
			}

			$listing->delete($pdo);
			$deletedObject = new stdClass();
			$deletedObject->listingId = $id;
			$pusher->trigger("misquote", "delete", $deletedObject);

			$reply->message = "Listing deleted OK";

		}
	} else {
		//if not an admin and attempting a method other than get, throw an exception
		if((empty($method) === false) && ($method !== "GET")) {
			throw(new RangeException("Only administrators are allowed to modify entries", 401));
		}
	}
} catch (Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_decode($reply);