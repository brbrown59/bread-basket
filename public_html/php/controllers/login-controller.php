<?php
//auto loads classes
require_once(dirname(dirname(__DIR__)) . "/php/classes/autoloader.php");
//security w/ NG in mind
require_once dirname(__DIR__) . "lib/xsrf.php";
//a security file that's on the server created by Dylan
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * controller for the logging in
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com
 * contributing code from TruFork https://github.com/Skylarity/trufork & foodinventory
 */

//start the session and create a XSRF token
if(session_start() !== PHP_SESSION_ACTIVE) {
	session_start();
}

// prepare default error message
$reply = new stdClass();
$reply->status = 401;
$reply->message = "Username/password incorrect";

try {
	// grab the my SQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/breadbasket.ini");

	// convert POSTed JSON to an object
	verifyXsrf();
	$requestContent = file_get_contents("php://input");
	$requestObject = json_decode($requestContent);

	// sanitize the email & search by volEmail
	$volEmail = filter_var($requestObject->volEmail, FILTER_SANITIZE_EMAIL);
	$volunteer = Volunteer::getVolunteerByVolEmail($pdo, $volEmail);

	if($volunteer !== null) {
		$volHash = hash_pbkdf2("sha512", $requestObject->password, $volunteer->getVolSalt(), 262144, 128);
		if($volHash === $volunteer->getVolHash()) {
			$_SESSION["volunteer"] = $volunteer;
			$reply->status = 200;
			$reply->message = "User logged in";
		}
	}
	// create an exception to pass bak to the RESTfull caller
}catch (Exception $exception) {
	// ignore them ToDo QUESTION does "them" mean the exception?
}

header("Content-type: application/json");
echo json_encode($reply);
