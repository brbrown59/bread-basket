<?php
/**
 * Message entity
 *
 * The Message entity is holds the information that is sent to the voluteers about donations available for pick up.
 *
 * @author Tamra Fentermaker <fenstermaker505@gmail.com>
 **/
class message {
	/**
	 * id for this message; this is the primary key
	 * @var int $messageId
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
}

/**
 * constructor for this message
 *
 * @param mixed $newMessageId new value of message id
 * @param int $newListingId new value of listing id
 * @param int $newOrgId new value of organization id
 * @param string $newMessageText new value for message text
@throws InvalidArgumentException if data types are not valid
 * @throws RangeException is data values are out of bounds (e.g., strings too long, negative integers)
 * @throws Exception is some other exception is thrown
 */
public function __construct($newMessageId, $newListingId, $newOrgId, $newMessageText = null) {
	try {
		$this->setMessageId($newMessageId);
		$this->setListingId($newListingId);
		$this->setNewOrgId($newOrgId);
		$this->setMessageText($newMessageText);
	} catch(InvalidArgumentException $invalidArguement) {
		//rethrow the exception to the caller
		throw(new InvalidArgumentException($invalidArguement->getMessage(), 0, $invalidArguement));
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
 */
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
 */
public function getMessageText() {
	return ($this->messageText);
}

/**
 *mutator method for message text
 *
 * @param string $newMessageText new value of  message text
 * @throws InvalidArgumentException if $newMessageText is not a string or insecure
 * @throws RangeException if $newMessageText is > 256 characters
 */
public function setMessageText($newMessageText) {
	//verify the listing memo is secure
	$newMessageText = trim($newMessageText);
	$newMessageText = filter_var($newMessageText, FILTER_SANITIZE_STRING);
	if(empty($newMessageText) === true) {
		throw(new InvalidArgumentException("message text is empty or insecure"));
	}
	//verify the message text will fit in the database
	if(strlen($newMessageText) > 256) {
		throw(new RangeException("message text is longer than 256 characters"));
	}
