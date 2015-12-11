<?php
/**
 * controller for sending a confirmation email to a new user
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributor code from https://github.com/sandidgec/foodinventory &
 * https://github.com/Skylarity/trufork
 **/

//auto loads classes
require_once(dirname(dirname(dirname((__DIR__)))) . "/php/classes/autoloader.php");
//security w/ NG in mind
require_once(dirname(dirname(dirname((__DIR__)))) . "/php/lib/xsrf.php");
//a security file that's on the server created by Dylan
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");
//composer for Swiftmailer
require_once(dirname(dirname(dirname(dirname(__DIR__)))) . "/vendor/autoload.php");


// prepare default error message
$reply = new stdClass();
$reply->status = 200;
$reply->data = null;

try {
	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/breadbasket.ini");

	$volEmailActivation = filter_input(INPUT_GET, "emailActivation", FILTER_SANITIZE_STRING);

	$volunteer = Volunteer::getVolunteerByVolEmailActivation($pdo, $volEmailActivation);

	if(empty($volunteer) === true) {
		throw (new InvalidArgumentException("Activation code has been activated or does not exist", 404));
	} else {
		$volunteer->setVolEmailActivation(null);
		$volunteer->update($pdo);
	}

	$reply->data = "Congratulations, your account has been activated!";
	//redirect them somewhere

} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->data = $exception->getMessage();
}


// building the activation link that can travel to another server and still work. This is the link that will be clicked to confirm the account.
$lastSlash = strrpos($_SERVER["SCRIPT_NAME"], "/");
$basePath = substr($_SERVER["SCRIPT_NAME"], 0, $lastSlash);

//iterate to get to the right path (gotta be a cleaner way to do this...)
for ($i=0; $i < 2; $i++) {
	$lastSlash = strrpos($basePath, "/");
	$basePath = substr($basePath, 0, $lastSlash);
}
$urlglue = $basePath . "/template/home.php";


header("Location: " . $urlglue);
header("Content-type: application/json");

if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);