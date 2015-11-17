<?php

		//grab the class under scrutiny
		require_once(dirname(__DIR__) . "/public_html/php/classes/administrator.php");
		require_once(dirname(__DIR__) . "/public_html/php/classes/organization.php");
		require_once(dirname(__DIR__) . "/public_html/php/classes/volunteer.php");
		require_once ("/etc/apache2/data-design/encrypted-config.php");

		//start the session and create a XSRF token
		if(session_status() !== PHP_SESSION_ACTIVE) {
			session_start();
		}

		//prepare an empty reply
		$reply = new stdClass();
		$reply->status = 200;
		$reply->data = null;

		try{

		}


?>