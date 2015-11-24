<?php

require_once dirname(dirname(__DIR__)) . "/classes/autoloader.php";
require_once dirname(dirname(__DIR__)) . "/lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
/**
 * controller/api for the volunteer class
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
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/breadbasket.ini");

	//temporary test field: please remove later
	//$_SESSION["volunteer"] = Volunteer::getVolunteerByVolId($pdo, 146);

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
	//sanitize and trim other fields
	$orgId = filter_input(INPUT_GET, "orgId", FILTER_VALIDATE_INT);
	$email = filter_input(INPUT_GET, "email", FILTER_SANITIZE_EMAIL);
	$admin = filter_input(INPUT_GET, "admin", FILTER_VALIDATE_BOOLEAN);
	$phone = filter_input(INPUT_GET, "phone", FILTER_SANITIZE_STRING);
	$emailActivation = filter_input(INPUT_GET, "emailActivation", FILTER_SANITIZE_STRING);

	//handle REST calls, while only allowing administrators to access database-modifying methods
	if($method === "GET") {
		//set XSRF cookie
		setXsrfCookie("/");

		//get the organization based on the given field
		if(empty($id) === false) {
			$reply->data = Volunteer::getVolunteerByVolId($pdo, $id);
		} else if(empty($orgId) === false) {
			$reply->data = Volunteer::getVolunteerByOrgId($pdo, $orgId)->toArray();
		} else if(empty($email) === false) {
			$reply->data = Volunteer::getVolunteerByVolEmail($pdo, $email)->toArray();
		} else if(empty($admin) === false) {
			$reply->data = Volunteer::getVolunteerByVolIsAdmin($pdo, $admin)->toArray();
		} else if(empty($phone) === false) {
			$reply->data = Volunteer::getVolunteerByVolPhone($pdo, $phone)->toArray();
		} else if(empty($emailActivation) === false) {
			$reply->data = Volunteer::getVolunteerByVolEmailActivation($pdo, $emailActivation)->toArray();
		} else {
			$reply->data = Volunteer::getAllVolunteers($pdo)->toArray();
		}
	}

	// if the session belongs to an admin, allow post, put, and delete methods.
	if(empty($_SESSION["volunteer"]) === false && $_SESSION["volunteer"]->getVolIsAdmin() === true) {

		if($method === "PUT" || $method === "POST") {

			verifyXsrf();
			$requestContent = file_get_contents("php://input");
			$requestObject = json_decode($requestContent);

			//make sure all fields are present, in order to prevent database issues
			if(empty($requestObject->orgId) === true) {
				throw(new InvalidArgumentException ("organization id cannot be empty", 405));
			}
			if(empty($requestObject->volEmail) === true) {
				throw(new InvalidArgumentException ("email cannot be empty", 405));
			}
			if(empty($requestObject->volEmailActivation) === true) {
				$requestObject->volEmailActivation = null;
			}
			if(empty($requestObject->volFirstName) === true) {
				throw(new InvalidArgumentException ("first name cannot be empty", 405));
			}
			//DO WE CHECK FOR A HASH?
			//if(empty($requestObject->volHash) === true) {
			//	throw(new InvalidArgumentException ("email cannot be empty", 405));
			//}
			if(empty($requestObject->volIsAdmin) === true) {
				$requestObject->volIsAdmin = null;
			}
			if(empty($requestObject->volLastName) === true) {
				throw(new InvalidArgumentException ("last name cannot be empty", 405));
			}
			if(empty($requestObject->volPhone) === true) {
				throw(new InvalidArgumentException ("phone cannot be empty", 405));
			}
			if(empty($requestObject->volEmail) === true) {
				throw(new InvalidArgumentException ("email cannot be empty", 405));
			}
			//WHAT DO WE DO FOR SALT?




}