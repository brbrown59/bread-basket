<?php

require_once dirname(__DIR__) . "/lib/xsrf.php";

/**
 * simple controller simply for handing out an xsrf token when booting the mobile app
 *
 * @author Bradley Brown tall.white.ninja@gmail.com
 */

if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}

setXsrfCookie('/');
