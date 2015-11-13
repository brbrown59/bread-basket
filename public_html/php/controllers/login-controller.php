<?php
//autoloads classes
require_once(dirname(dirname(__DIR__)) . "/php/classes/autoloader.php");
//security w/ NG in mind
require_once dirname(__DIR__)."lib/xsrf.php";
//a security file that's on the server created by Dylan
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * controller for the logging in
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com
 * contributing code from TruFork https://github.com/Skylarity/trufork
 */
try {
	//ensures that the fields are filled out
	if(@isset($_POST["volEmail"]) === false || @isset($_POST["Password"]) === false) {
		throw(new InvalidArgumentException("form not complete. Please verify and try again"));
	}
	// verify the XSRF challenge
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	verifyXsrf();
	// create a salt and hash for user
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/breadbasket.ini");
	$volunteer = Volunteer::getVolunteerByVolEmail($pdo, $_POST["volEmail"]);
	if($volunteer === null) {
		throw(new InvalidArgumentException("email or password is invalid"));
	}
	$volHash = hash_pbkdf2("sha512", $_POST["Password"], $volunteer->getVolSalt(), 262144, 128);
	if($volHash !== $volunteer->getVolHash()) {
		throw(new InvalidArgumentException("email or password is invalid"));
	}
	$_SESSION["volunteer"] = $volunteer;
	$volFirstName = $_SESSION["volunteer"]->getVolFirstName();
	echo "<p class=\"alert alert-success\">Welcome Back, " . $volFirstName . "!<p/>";
} catch(Exception $exception) {
	echo "<p class=\"alert alert-danger\">Exception: " . $exception->getMessage() . "</p>";
}
