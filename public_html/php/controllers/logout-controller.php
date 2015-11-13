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
header("Location:index.php");