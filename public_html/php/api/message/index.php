<?php
/**
 *
 * MESSAGE API for message class
 * @author Carlos Beraun <cberaun2@cnm.edu>
 */

		//grab the class under scrutiny
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

		try {
			//grab the mySQL connection
			$pdo = connectToEncryptedMySQL("/etc/apache/capstone-mysql/breadbasket.ini");

			//if the volunteer session is empty, the user is not logged in, throw an exception
			if(empty($_SESSION["volunteer"]) === true) {
				throw(new RuntimeException("Please log in or sign up", 401));
			}

			//determine which HTTP method was used
			$method = array_key_exists("HTTP_X_HTTP_METHOD", $_SERVER) ? $_SERVER["HTTP_X_HTTP_METHOD"] : $_SERVER["REQUEST_METHOD"];

			//sanitize inputs
			$id = filter_input(INPUT_GET, "id", FILTER_VALIDATE_INT);
			$id = filter_input(INPUT_GET, "listingId", FILTER_VALIDATE_INT);
			$id = filter_input(INPUT_GET, "orgId", FILTER_VALIDATE_INT);
			//make sure the id is valid for methods that requier it.
			if(($method === "DELETE" || $method === "PUT") && (empty ($id) === true || $id < 0)) {
				throw(new InvalidArgumentException("id cannot be empty or negative", 405));
			}


			//sanitize and trim the other fields
			//------did not need----------//


			//handle REST calls, while only allowing administrators access to database-modifying methods
			//should already have checked if they're a volunteer, so another check here would ne redundant
			if($method === "GET") {
				//set XSRF cookie
				setXrftCookie("/");
				//get the organization based on the given field
				if(empty($id) === false) {
					$reply->data = Message::getMessageByMessageId($pdo, $Id)->toArray();
				} else if(empty ($listingId) === false) {
					$reply->data = Message::getMessageByListingId($pdo, $listingId)->toArray();
				} else if(empty ($orgId) === false) {
					$reply->data = Message::getMessageByOrgId($pdo, $orgId)->toArray();
				}
			}

			//if the session belongs to an Administrator, Allow; post, put and delete methods
			if(empty($_SESSION["volunteer"]) === false && $_SESSION["volunteer"]->getVolIsAdmin() === true) {

				if($method === "put" || $method === "POST") {

					verifyXsrf();
					$requestContent = file_get_contents("php://input");
					$requestObject = json_decode($requestContent);

					//make sure all fields are present, in order to prevent database issues
					if(empty($requestObject->)) ;
					//------------did not add-----------//
				}


				//perform the actual put or post
				if($method === "PUT") {
					$message = Message::getMessageByMessageId($pdo, $id);
					if($message === null) {
						throw(new RuntimeException("Message does not exist", 404));
					}

					$message = new Message($id, $requestObject->listingId, $requestObject->orgId);
					$message->update($pdo);

					$reply->message = "Message updated Ok";

				} else if($method === "POST") {
					$message = new Message(null, $requestObject->listingId, $requestObject->orgId);
					$message->insert($pdo);

					$reply->message = "Message created ok";
				}

			} else if($method === "DELETE") {
				verifyXsrf();

				$message = Message::getMessageByMessageId($pdo, $id);
				if($message === null) {
					throw(new RuntimeException("Message does not exist", 404));
				}

				$message->delete($pdo);
				$deleteObject = new stdClass();
				$deleteObject->messageId = $id;

				$reply->message = "Message deleted successfully";
			} else {
				//if not Administrator, and attempting a method other than get, throw a exception.
				if((empty($method) === false) && ($method !== "GET")) {
					throw(new RangeException("Only Administrators are allowed to modify messages", 401));
				}
			}

			//send exception back to the caller
		}catch (Exception $exception) {
			$reply->status = $exception->getCode();
			$reply->message = $exception->getMessage();
		}
		header("content-type: applications/json");
if($reply->data === null){
	unset($reply->data);
}
echo json_encode($reply);

?>