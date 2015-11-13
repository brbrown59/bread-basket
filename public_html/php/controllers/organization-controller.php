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
	//if the session is empty, throw an exception
	//might put this in session status instead?
	if(empty($_SESSION["volunteer"]) == true) {
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