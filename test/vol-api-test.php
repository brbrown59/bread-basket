<?php
//grab the project test parameters
require_once("bread-basket.php");

//grab the auto loader for the composer classes
require_once(dirname(dirname(dirname(_DIR_))) . "/vendor/autoloader.php");

//grab the class under scrutiny
require_once(dirname(__DIR__) . "/public_html/php/classes/volunteer.php");
require_once(dirname(__DIR__) . "/public_html/php/classes/organization.php");

/*
 * full PHPunit test for the Volunteer Api
 */


}