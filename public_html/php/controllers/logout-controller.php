<?php
/**
 * controller for the logging out
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com
 * contributing code from TruFork https://github.com/Skylarity/trufork
 */

if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
unset($_SESSION["volunteer"]);
//header("Refresh:0");
//echo "foo!";
header("Location:index.php");