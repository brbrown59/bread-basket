<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
/**
 * controller/api for the listing type class
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
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
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/breadbasket.ini");

	//if the volunteer session is empty, the user is not logged in, throw an exception
	if(empty($_SESSION["volunteer"]) === true) {
		throw(new RuntimeException("Please log-in or sign up", 401));
		//set XSRF cookie
		setXsrfCookie("/");
	}

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	//sanitize and trim the Listing Type (Info) fields
	$listingType = filter_input(INPUT_GET, "listingType", FILTER_SANITIZE_STRING);

	//handle REST calls, while only allowing administrators access to database-modifying methods Todo different from organization
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		//get the listing type based on the given field todo else if is wrong, but I need to know why getListingTypeInfo()
		if(empty($id) === false) {
			$reply->data = ListingType::getListingTypeById($pdo, $id);
		} elseif(empty()) {
			$reply->data = ListingType::getListingByTypeInfo($pdo, $listingType);
		} elseif(empty()) {
			$reply->data = ListingType::getAllListingTypes($pdo)->toArray();
		}

	}

	//if the session belongs to an admin, allow post, put, and delete methods
	if(empty($_SESSION["volunteer"]) === false && $_SESSION["volunteer"]->getVolIsAdmin() === true) {

		if($method === "PUT" || $method === "POST") {

			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//make sure all fields are present, in order to prevent database issues
			if(empty($requestObject->listingTypeId) === true) {
				throw(new InvalidArgumentException ("listing type id cannot be empty", 405));
			}


			//perform the actual put or post
			if($method === "PUT") {
				$organization = Organization::getOrganizationByOrgId($pdo, $id);
				if($organization === null) {
					throw(new RuntimeException("Organization does not exist", 404));
				}

				$organization = new Organization($id, $requestObject->orgAddress1, $requestObject->orgAddress2, $requestObject->orgCity,
						$requestObject->orgDescription, $requestObject->orgHours, $requestObject->orgName, $requestObject->orgPhone, $requestObject->orgState,
						$requestObject->orgType, $requestObject->orgZip);
				$organization->update($pdo);

				$reply->message = "Organization updated OK";

			} else if($method === "POST") {
				$organization = new Organization(null, $requestObject->orgAddress1, $requestObject->orgAddress2, $requestObject->orgCity,
						$requestObject->orgDescription, $requestObject->orgHours, $requestObject->orgName, $requestObject->orgPhone, $requestObject->orgState,
						$requestObject->orgType, $requestObject->orgZip);
				$organization->insert($pdo);

				$reply->message = "Organization created OK";
			}

		} else if($method === "DELETE") {
			verifyXsrf();

			$organization = Organization::getOrganizationByOrgId($pdo, $id);
			if($organization === null) {
				throw(new RuntimeException("Organization does not exist", 404));
			}

			$organization->delete($pdo);
			$deletedObject = new stdClass();
			$deletedObject->organizationId = $id;

			$reply->message = "Organization deleted OK";
		}

	} else {
		//if not an admin, and attempting a method other than get, throw an exception
		if((empty($method) === false) && ($method !== "GET")) {
			throw(new RuntimeException("Only administrators are allowed to modify entries", 401));
		}
	}

} catch(Exception $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);