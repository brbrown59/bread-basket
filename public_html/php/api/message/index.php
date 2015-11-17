<?php
/**
 *
 * MESSAGE API for message class
 * @author Carlos Beraun <cberaun2@cnm.edu>
 */

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
			//grab the mySQL connection
			$pdo = connectToEncryptedMySQL("/etc/apache/capstone-mysql/breadbasket.ini");

			//if the volunteer session is empty, the user is not logged in, throw an exception
			if(empty($_SESSION["volunteer"]) === true){
				throw(new RuntimeException("Please log in or sign up", 401));
			}

			//determine which HTTP method was used
			$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

			//sanitize inputs
			$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
			$id = filter_input(INPUT_GET,"listingId",FILTER_VALIDATE_INT);
			$id = filter_input(INPUT_GET,"orgId",FILTER_VALIDATE_INT);

			//make sure the id is valid for methods that requier it.
			if(($method === "DELETE" || $method === "PUT") && (empty ($id) === true || $id < 0)){
				throw(new InvalidArgumentException("id cannot be empty or negative",405));
			}
			//sanitize and trim the other fields
			//------did not need----------//

			//handle REST calls, while only allowing administrators access to database-modifying methods
			//should already have checked if they're a volunteer, so another check here would ne redundant
			if($method === "GET"){
				//set XSRF cookie
				setXrftCookie("/");
				//get the organization based on the given field
				if(empty($id) === false) {
					$reply->data = Organization::getOrganization
				}
			}




		}

?>