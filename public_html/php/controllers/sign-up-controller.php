<?php
/**
 * controller for the signing up a new volunteer
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributor code from https://github.com/Skylarity/trufork
 **/

//autoloads classes
require_once(dirname(dirname(__DIR__)) . "/php/classes/autoloader.php");
//security w/ NG in mind
require_once(dirname(dirname(__DIR__)) . "/php/lib/xsrf.php");
//a security file that's on the server created by Dylan
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

try {
	//ensures that the fields are filled out TODO Where are the passwords compared to determine if they are the same? front end?
	if(@isset($_POST["volFirstName"]) === false || @isset($_POST["volLastName"]) === false || @isset($_POST["volEmail"]) === false || @isset($_POST["password"]) === false || @isset($_POST["verifyPassword"]) === false); {
		throw(new InvalidArgumentException("form not complete. Please verify and try again"));
	}
	// verify the XSRF challenge
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	verifyXsrf();


	// create a salt and hash for volunteer
	$volSalt = bin2hex(openssl_random_pseudo_bytes(32));
	$volHash = hash_pbkdf2("sha512", $_POST["password"], $volSalt, 262144, 128);

	//create a new volunteer id and insert in mySQL
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/breadbasket.ini");

	//TODO why not posting salt and/or hash, should I set the activation here by saying true instead of the $volEmailActivation? What are we doing with OrgId? I decided to post salt.
//This needs to be more like what we talked about in scrum
//	FILE GET CONTENTS
//“NAME” “KIMBERLY KELLER”, “EMIAL:”“ENSINKELLER@CNM.EDU” THIS STRING >>> PHP://INPUT
//	$volunteer = new Volunteer(null, $orgId, $_POST[volEmail], $volEmailActivation, $_POST[volFirstName], $volHash, $_POST[volLastName], $_POST[volPhone], $_POST[volSalt]);
	$volunteer->insert($pdo);

	//TODO what's the syntax to pull first name and last name?
	echo "<p class=\"alert alert-success\">Check your email to confirm your account." . $volunteer->getVolFirstName($pdo, "volFirstName",) $volunteer->getVolLastName($pdo, "volLastName") . "<p/>";
} catch(Exception $exception) {
	echo "<p class=\"alert alert-danger\">Exception: " . $exception->getMessage() . "</p>";
}
