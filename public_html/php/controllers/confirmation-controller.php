<?php
/**
 * controller for sending a confirmation email to a new user
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributor code from https://github.com/sandidgec/foodinventory &
 * https://github.com/Skylarity/trufork
 **/

//auto loads classes
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
}
verifyXsrf();
