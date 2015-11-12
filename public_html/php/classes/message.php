<?php
/**
 * Message entity
 *
 * The Message entity is holds the information that is sent to the volunteers about donations available for pick up.
 *
 * @author Tamra Fentermaker <fenstermaker505@gmail.com>
 **/
class Message {
	/**
	 * id for this message; this is the primary key
	 * @var int $messageId
	 **/
	private $messageId;
	/**
	 * id for listing; this is the a foreign key
	 * @var int $listingId
	 **/
	private $listingId;
	/**
	 * id of the organization (org) that listed the donation; this is a foreign key
	 * @var int $orgId
	 **/
	private $orgId;
	/**
	 * the content of the Message
	 * @var string $messageText
	 **/
	private $messageText;

/**
 * constructor for this message
 *
 * @param mixed $newMessageId new value of message id
 * @param int $newListingId new value of listing id
 * @param int $newOrgId new value of organization id
 * @param string $newMessageText new value for message text
 * @throws InvalidArgumentException if data types are not valid
 * @throws RangeException is data values are out of bounds (e.g., strings too long, negative integers)
 * @throws Exception is some other exception is thrown
 **/
public function __construct($newMessageId, $newListingId, $newOrgId, $newMessageText) {
	try {
		$this->setMessageId($newMessageId);
		$this->setListingId($newListingId);
		$this->setOrgId($newOrgId);
		$this->setMessageText($newMessageText);
	} catch(InvalidArgumentException $invalidArgument) {
		//rethrow the exception to the caller
		throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
	} catch(RangeException $range) {
		//rethrow the exception to the caller
		throw(new RangeException($range->getMessage(), 0, $range));
	} catch(Exception $exception) {
		//rethrow generic exception
		throw(new Exception($exception->getMessage(), 0, $exception));
	}
}

/**
 * accessor method for message id
 *
 * @return mixed value for message id
 **/
public function getMessageId() {
	return ($this->messageId);
}

/**
 * mutator method for message id
 *
 * @param mixed $newMessageId new value of message id
 * @throws InvalidArgumentException if $newMessageId is not an integer
 * @throws RangeException is $newMessageId is not positive
 **/
public function setMessageId($newMessageId) {
	//base case: if the message id is null, this a new message without a mySQL assigned id (yet)
	if($newMessageId === null) {
		$this->messageId = null;
		return;
	}
	//verify the message id is valid
	$newMessageId = filter_var($newMessageId, FILTER_VALIDATE_INT);
	if($newMessageId === false) {
		throw(new InvalidArgumentException("message id is not a valid integer"));
	}
	//verify the message id is positive
	if($newMessageId <= 0) {
	throw(new RangeException("message id is not positive"));
	}
	//convert and store the message id
	$this->messageId = intval($newMessageId);
}

/**
 * accessor method for listing id
 *
 * @return mixed value for listing id
 **/
public function getListingId() {
	return ($this->listingId);
}

/**
 * mutator method for listing id
 *
 * @param mixed $newListingId new value of listing id
 * @throws InvalidArgumentException if $newListingId is not an integer
 * @throws RangeException is $newListingId is not positive
 **/
public function setListingId($newListingId) {
	//base case: if the listing id is null, this a new listing without a mySQL assigned id (yet)
	if($newListingId === null) {
		$this->listingId = null;
		return;
	}
	//verify the listing id is valid
	$newListingId = filter_var($newListingId, FILTER_VALIDATE_INT);
	if($newListingId === false) {
		throw(new InvalidArgumentException("listing id is not valid"));
	}
	//verify the listing id is positive
	if($newListingId <= 0) {
		throw(new RangeException("listing if is not positive"));
	}

	//convert and store the listing id
	$this->listingId = intval($newListingId);
}

/**
 * accessor method for the organization id
 *
 * @return int value of organization id
 **/
public function getOrgId() {
	return ($this->orgId);
}

/**
 * mutator method for organization id
 *
 * @param int $newOrgId new value of organization id
 * @throws InvalidArgumentException if $newOrgId is not an integer or not positive
 * @throws RangeException if $newOrgId is not positive
 **/
public function setOrgId($newOrgId) {
	//verify the organization id is valid
	$newOrgId = filter_var($newOrgId, FILTER_VALIDATE_INT);
	if($newOrgId === false) {
		throw(new InvalidArgumentException("organization id is not a valid integer"));
	}

	//verify the organization id is positive
	if($newOrgId <= 0) {
		throw(new RangeException("organization if is not positive"));
	}

	//convert and store the organization id
	$this->orgId = intval($newOrgId);
}
/**
 * accessor method for message text
 *
 * @return string value of message text
 **/
public function getMessageText() {
	return ($this->messageText);
}

/**
 *mutator method for message text
 *
 * @param string $newMessageText new value of  message text
 * @throws InvalidArgumentException if $newMessageText is not a string or insecure
 * @throws RangeException if $newMessageText is > 256 characters
 **/
public function setMessageText($newMessageText) {
	//verify the message text is secure
	$newMessageText = trim($newMessageText);
	$newMessageText = filter_var($newMessageText, FILTER_SANITIZE_STRING);
	if(empty($newMessageText) === true) {
		throw(new InvalidArgumentException("message text is empty or insecure"));
	}
	//verify the message text will fit in the database
	if(strlen($newMessageText) > 256) {
		throw(new RangeException("message text is longer than 256 characters"));
	}
	//store the Message Text
	$this->messageText = $newMessageText;
}
	/**
	 * inserts this message into mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @throws PDOException when mySQL related errors occur
	 **/
	public function insert(PDO $pdo) {
		//enforce the messageId is null (i.e., don't insert a message id that already exists)
		if($this->messageId !== null) {
			throw(new PDOException("not a new message"));
		}
		//create query template
		$query = "INSERT INTO message(messageId, listingId, orgId, messageText)VALUES(:messageId,:listingId,:orgId,:messageText)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = array("messageId" => $this->messageId, "listingId" => $this->listingId, "orgId" => $this->orgId, "messageText" => $this->messageText);
		$statement->execute($parameters);

		//update the null messageId with what mySQL just gave us
		$this->messageId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this message in mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @throws PDOException when mySQL related errors occur
	 **/
	public function delete(PDO $pdo) {
		//enforce the message id is not null (i.e., don't delete a message that hasn't been inserted)
		if($this->messageId === null) {
			throw(new PDOException("unable to delete a message that does not exist"));
		}

		//create query template
		$query = "DELETE FROM message WHERE messageId = :messageId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = array("messageId" => $this->messageId);
		$statement->execute($parameters);
	}

	/**
	 * updates this message in mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @throws PDOException when mySQL related errors occur
	 **/
	public function update(PDO $pdo) {
		//enforce the messageId is not null (i.e., don't update a message that hasn't been inserted)
		if($this->messageId === null) {
			throw(new PDOException("unable to update a message that does not exist"));
		}
		//create query template
		$query = "UPDATE message SET messageId = :messageId,listingId = :listingId,orgId = :orgId,messageText = :messageText";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = array("messageId" => $this->messageId,"listingId" => $this->listingId,"orgId" => $this->orgId, "messageText" => $this->messageText);
		$statement->execute($parameters);
	}

	/**
	 * gets the message by messageId
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @param int $messageId message id to search for
	 * @return mixed message found or null if not found
	 * @throws PDO Exceptions when my SQL related errors occur
	 **/
	public static function getMessageByMessageId(PDO $pdo, $messageId) {
		//sanitize the messageId before searching
		$messageId = filter_var($messageId, FILTER_VALIDATE_INT);
		if($messageId === false) {
			throw(new PDOException("message id is not a valid integer"));
		}

		//verify the message id is positive
		if($messageId <= 0) {
			throw(new PDOException("message id is not positive"));
		}

		//create query template
		$query = "SELECT messageId, listingId, orgId, messageText FROM message WHERE messageId = :messageId";
		$statement = $pdo->prepare($query);

		//bind the message id to the place holder in the template
		$parameters = array("messageId" => $messageId);
		$statement->execute($parameters);

		//grab the message from mySQL
		try {
			$message = null;
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$message = new message($row["messageId"], $row["listingId"], $row["orgId"], $row["messageText"]);
			}
		} catch(Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return ($message);
	}

	/**
	 * gets the message by listingId
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @param int $listingId listing id to search for
	 * @return mixed message found or null if not found
	 * @throws PDO Exceptions when my SQL related errors occur
	 **/
public static function getMessageByListingId(PDO $pdo, $listingId) {
		//sanitize the listingId before searching
		$listingId = filter_var($listingId, FILTER_VALIDATE_INT);
		if($listingId === false) {
			throw(new PDOException("listing id is not a valid integer"));
		}

		//verify the listing id is positive
		if($listingId <= 0) {
			throw(new PDOException("listing id is not positive"));
		}

		//create query template
		$query = "SELECT messageId, listingId, orgId, messageText FROM message WHERE listingId = :listingId";
		$statement = $pdo->prepare($query);

		//bind the listing id to the place holder in the template
		$parameters = array("listingId" => $listingId);
		$statement->execute($parameters);

	//call the function to build an array of the retrieved results
	try {
		$retrievedMessages = Message::storeSQLResultsInArray($statement);
	} catch(Exception $exception) {
		//rethrow the exception if retrieval failed
		throw(new PDOException($exception->getMessage(), 0, $exception));
	}
	return $retrievedMessages;
}

	/**
	 * gets the message by orgId
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @param int $orgId organization id to search for
	 * @return mixed message found or null if not found
	 * @throws PDO Exceptions when my SQL related errors occur
	 **/
	public static function getMessageByOrgId(PDO $pdo, $orgId) {
		//sanitize the orgId before searching
		$orgId = filter_var($orgId, FILTER_VALIDATE_INT);
		if($orgId === false) {
			throw(new PDOException("organization id is not a valid integer"));
		}

		//verify the organization id is positive
		if($orgId <= 0) {
			throw(new PDOException("organization id is not positive"));
		}

		//create query template
		$query = "SELECT messageId, listingId, orgId, messageText FROM message WHERE orgId = :orgId";
		$statement = $pdo->prepare($query);

		//bind the organization id to the place holder in the template
		$parameters = array("orgId" => $orgId);
		$statement->execute($parameters);


		//call the function to build an array of the retrieved results
		try {
			$retrievedMessages = Message::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedMessages;
	}
	/**
	 * retrieves all messages
	 *
	 * @param PDO $pdo pdo connection object
	 * @return SplFixedArray all messages
	 * @throws PDOException if mySQL errors occur
	 */
	public static function getAllMessages(PDO $pdo) {

		//create query template
		$query = "SELECT messageId, listingId, orgId, messageText FROM message";
		$statement = $pdo->prepare($query);
		$statement->execute();

		///call the function to build an array of the retrieved results
		try {
			$retrievedMessages = Message::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedMessages;
	}
	/**
	 * function to store multiple database results into an SplFixedArray
	 *
	 * @param PDOStatement $statement pdo statement object
	 * @return SPLFixedArray all message obtained from database
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function storeSQLResultsInArray(PDOStatement $statement) {
		//build an array of messages, as an SPLFixedArray object
		//set the size of the object to the number of retrieved rows
		$retrievedMessages = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);

		//while rows can still be retrieved from the result
		while(($row = $statement->fetch()) !== false) {
			try {
				$message = new Message($row["messageId"], $row["listingId"], $row["orgId"], $row["messageText"]);

				//place result in the current field, then advance the key
				$retrievedMessages[$retrievedMessages->key()] = $message;
				$retrievedMessages->next();
			} catch(Exception $exception) {
				//rethrow the exception if retrieval failed
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $retrievedMessages;
	}


}