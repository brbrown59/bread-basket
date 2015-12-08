<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
/**
 * controller/api for the organization class
 *
 * allow for interaction with the rest of the backend via restful API calls
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
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
		setXsrfCookie("/");
		throw(new RuntimeException("Please log-in or sign up", 401));
	}

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//sanitize inputs
	$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
	//make sure the id is valid for methods that require it
	if(($method === "DELETE" || $method === "PUT") && (empty($id) === true || $id < 0)) {
		throw(new InvalidArgumentException("id cannot be empty or negative", 405));
	}
	//sanitize and trim the other fields
	$city = filter_input(INPUT_GET, "city", FILTER_SANITIZE_STRING);
	$name = filter_input(INPUT_GET, "name", FILTER_SANITIZE_STRING);
	$state = filter_input(INPUT_GET, "state", FILTER_SANITIZE_STRING);
	$type = filter_input(INPUT_GET, "type", FILTER_SANITIZE_STRING);
	$zip = filter_input(INPUT_GET, "zip", FILTER_SANITIZE_STRING);
	$current = filter_input(INPUT_GET, "current", FILTER_SANITIZE_STRING);


	//handle REST calls, while only allowing administrators access to database-modifying methods
	//should already have checked if they're a volunteer, so another check here would be redundant
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		//get the organization based on the given field
		if(empty($id) === false) {
			$reply->data = Organization::getOrganizationByOrgId($pdo, $id);
		} else if(empty($city) === false) {
			$reply->data = Organization::getOrganizationByOrgCity($pdo, $city)->toArray();
		} else if(empty($name) === false) {
			$reply->data = Organization::getOrganizationByOrgName($pdo, $name)->toArray();
		} else if(empty($type) === false) {
			$reply->data = Organization::getOrganizationByOrgType($pdo, $type)->toArray();
		} else if(empty($zip) === false) {
			$reply->data = Organization::getOrganizationByOrgZip($pdo, $zip)->toArray();
		} else if(empty ($current) === false) {
			//used to fetch the current organization info for angular
			$reply->data = Organization::getOrganizationByOrgId($pdo, $_SESSION["volunteer"]->getOrgId());
		} else {
			$reply->data = Organization::getAllOrganizations($pdo)->toArray();
		}

	}

	//if the session belongs to an admin, allow post, put, and delete methods
	if(empty($_SESSION["volunteer"]) === false && $_SESSION["volunteer"]->getVolIsAdmin() === true) {

		if($method === "PUT" || $method === "POST") {

			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//make sure all fields are present, in order to prevent database issues
			if(empty($requestObject->orgAddress1) === true) {
				throw(new InvalidArgumentException ("organization address cannot be empty", 405));
			}
			if(empty($requestObject->orgAddress2) === true) {
				$requestObject->orgAddress2 = null;
			}
			if(empty($requestObject->orgCity) === true) {
				throw(new InvalidArgumentException ("organization city cannot be empty", 405));
			}
			if(empty($requestObject->orgDescription) === true) {
				$requestObject->orgDescription = null;
			}
			if(empty($requestObject->orgHours) === true) {
				$requestObject->orgHours = null;
			}
			if(empty($requestObject->orgName) === true) {
				throw(new InvalidArgumentException ("organization name cannot be empty", 405));
			}
			if(empty($requestObject->orgPhone) === true) {
				throw(new InvalidArgumentException ("organization phone number cannot be empty", 405));
			}
			if(empty($requestObject->orgState) === true) {
				throw(new InvalidArgumentException ("organization state cannot be empty", 405));
			}
			if(empty($requestObject->orgType) === true) {
				throw(new InvalidArgumentException ("organization type cannot be empty", 405));
			}
			if(empty($requestObject->orgZip) === true) {
				throw(new InvalidArgumentException ("organization zip code cannot be empty", 405));
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

	//send exception back to the caller
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);