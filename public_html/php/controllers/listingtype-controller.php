<?php

require_once dirname(__DIR__)."/classes/autoloader.php";
require_once dirname(__DIR__)."/classes/listingtype.php";
require_once dirname(__DIR__)."lib/xsrf.php";
require_once("/etc/apache2/capstone-mysql/encrypted-config.php");

/**
 * controller/api for the listingtype class
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

} catch(Exception $exception) {
	$reply->status = $exception->getCode();
	$reply->message = $exception->getMessage();
}


header("Content-type: application/json");
if($reply->data === null) {
	unset($reply->data);
}
echo json_encode($reply);
