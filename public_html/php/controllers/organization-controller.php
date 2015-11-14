<?php

//autoload?
require_once dirname(__DIR__)."/classes/organization.php";
require_once dirname(__DIR__)."lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * controller/api for the organization class
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 */
try {

	//verify the xsrf challenge
	if(session_status() !== PHP_SESSION_ACTIVE) {
		session_start();
	}
	//if the volunteer session is empty, and the user is not logged in, throw an exception
	//note: this may be redundant with some logic below, and is this what we should check?
	//also, ensure that BOTH volunteer and admin are set for an admin instance, rather than just one or the other
	if(empty($_SESSION["volunteer"]) === true) {
		throw(new RuntimeException("Please log-in or sign up"));
	}

	verifyXsrf();

	//prepare an empty pusher reply
	$reply = new stdClass();
	$reply->status = 200;
	$reply->data = null;

	//create the pusher connection
	//make sure pusher details get put into the config file!!!!
	//does EVERY class need to push things (I assume so)?
	$config = readConfig("/etc/apache2/capstone-mysql/breadbasket.ini");
	$pusherConfig = json_decode($config["pusher"]);
	$pusher = new Pusher($pusherConfig->key, $pusherConfig->secret, $pusherConfig->id, ["encrypted" => true]);

	//determine which HTTP method was used
	$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

	//TODO: possible input sanitization? How do I know for sure what I'm getting (ex: id vs city?)

	//grab the mySQL connection
	$pdo = connectToEncryptedMySQL("/etc/apache2/capstone-mysql/encrypted-config.ini");

	//handle REST calls, while only allowing administrators access to database-modifying methods
	if(empty($_SESSION["volunteer"]) === false) { //note: is this redundant with the check above?
		if($method === "GET") {
			//set XSRF cookie
			setXsrfCookie("/");
			//TODO: this is where all of the get foo by bar functions are going, since they can get on several fields
			//TODO: also, at end of if/else block will be a base case of get everything
		}
	}
	//if the session belongs to an admin, allow post, put, and delete methods
	if(empty($_SESSION["admin"]) === false) {
		//POST, PUT, DELETE here

	} else {
		//if not an admin, and attempting a method other than get, throw an exception
		if((empty($method) === false) && ($method !== "GET")) {
			throw new RuntimeException("Only administrators are allowed to modify entries");
		}
	}


} catch(Exception $exception) {
	//send exception back to the caller
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}
header("Content-type: application/json");
if($reply->data == null) {
	unset($reply->data);
}
echo json_encode($reply);