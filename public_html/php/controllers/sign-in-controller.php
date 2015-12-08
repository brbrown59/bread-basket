<?php
//auto loads classes
require_once(dirname(dirname(__DIR__)) . "/php/classes/autoloader.php");
//security w/ NG in mind
require_once(dirname(__DIR__) . "/lib/xsrf.php");
//a security file that's on the server created by Dylan because it's on the server it's not found
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * controller for the logging in
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributing code from TruFork https://github.com/Skylarity/trufork & foodinventory
 */

// prepare default error message
$reply = new stdClass();
$reply->status = 200;
$reply->message = null;


try {
	//start the session and create a XSRF token
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	verifyXsrf();

	// grab the my SQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/breadbasket.ini");

	// convert POSTed JSON to an object
	$requestContent = file_get_contents("php://input");
	$requestObject = json_decode($requestContent);

	// sanitize the email & search by volEmail
	$email = filter_var($requestObject->email, FILTER_SANITIZE_EMAIL);
	$volunteer = Volunteer::getVolunteerByVolEmail($pdo, $email);

	if($volunteer !== null) {
		$volHash = hash_pbkdf2("sha512", $requestObject->password, $volunteer->getVolSalt(), 262144, 128);
		if($volHash === $volunteer->getVolHash()) {
			$_SESSION["volunteer"] = $volunteer;
			$reply->status = 200;
			$reply->message = "Successfully logged in";
		} else {
			throw(new InvalidArgumentException("email or password is invalid", 401));
		}
	} else {
		throw(new InvalidArgumentException("email or password is invalid", 401));
	}
	// create an exception to pass back to the RESTfull caller
} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}

header("Content-type: application/json");
echo json_encode($reply);