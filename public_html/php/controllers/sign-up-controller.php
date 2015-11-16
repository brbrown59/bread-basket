<?php
/**
 * controller for the signing up a new user
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributor code from https://github.com/sandidgec/foodinventory &
 * https://github.com/Skylarity/trufork
 **/

//autoloads classes
require_once(dirname(dirname(__DIR__)) . "/php/classes/autoloader.php");
//security w/ NG in mind
require_once(dirname(dirname(__DIR__)) . "/php/lib/xsrf.php");
//a security file that's on the server created by Dylan
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
//composer for Swiftmailer
require_once(dirname(dirname(dirname(__DIR__))) . "/vendor/autoload.php");

//start the session and create a XSRF token
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
	verifyXsrf();
}
// prepare default error message
$reply = new stdClass();
$reply->status = 401;
$reply->message = "Incorrect email or password. Try again.";
$reply->status = 405;
$reply->message = "This email already has an account";


try {
	// grab the my SQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/breadbasket.ini");

	// convert POSTed JSON to an object
	$requestContent = file_get_contents("php://input");
	$requestObject = json_decode($requestContent);

	// sanitize the email & search by volEmail TODO should I trim here?
	$email = filter_var($requestObject->email, FILTER_SANITIZE_EMAIL);
	$volunteer = Volunteer::getVolunteerByVolEmail($pdo, $email);
	if($volunteer !== null) {
		throw(new InvalidArgumentException("This email already has an account", 405));
		// TODO add code to redirect to sign in page??
	}

	if($volunteer === null) {
		// create a new salt and email activation
		$volSalt = bin2hex(openssl_random_pseudo_bytes(32));
		$volEmailActivation = bin2hex(openssl_random_pseudo_bytes(8));

		// create the hash
		$volHash = hash_pbkdf2("sha512", $requestObject->password, $volSalt, 262144, 128);

		//create a new Volunteer and insert into mySQL TODO add Is admin
		$volunteer = new Volunteer(null, null, $requestObject->volEmail, $volEmailActivation, $requestObject->volFirstName, $volHash, $requestObject->volLastName, $requestObject->volPhone, $volSalt);
		$volunteer->insert($pdo);

		//create a new organization and insert into mySQL
		$organization = new Organization(null, $requestObject->orgAddress1, $requestObject->orgAddress2, $requestObject->orgCity, $requestObject->orgDescription, $requestObject->orgHours, $requestObject->orgName, $requestObject->orgPhone, $requestObject->orgState, $requestObject->orgType, $requestObject->orgZip);
		$organization->insert($pdo);
		$reply->message = "New organization has been created";

		//echo "<p class=\"alert alert-success\">Check your email to confirm your account." . $volunteer->getVolFirstName() . "<p/>";

		// create an exception to pass back to the RESTfull caller
		}
] catch(Exception $exception) {
		$reply->status = $exception->getCode();
		$reply->message = $exception->getMessage();
	}


	header("Content-type: application/json");
	if($reply->data === null) {
		unset($reply->data);
	}
	echo json_encode($reply);
}