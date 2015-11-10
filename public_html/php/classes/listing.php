<?php
require_once("../traits/date-parsing-trait.php");

/**
 * Listing entity
 *
 * The Listing entity is that holds the information about donations available for pick up by the food bank volunteers.
 *
 * @author Tamra Fentermaker <fenstermaker505@gmail.com>
 **/
class Listing {
	/**
	 * trait that will validate the listing post time
	 */
	use ValidateDate;
	/**
	 * id for this listing; this is the primary key
	 * @var int $listingId
	 **/
	private $listingId;
	/**
	 * id of the organization (org) that listed the donation; this is a foreign key
	 * @var int $orgId
	 **/
	private $orgId;
	/**
	 * the volunteer Id of ($volId primary key)  of the volunteer who claims the donation
	 * @var int $listingClaimedBy
	 **/
	private $listingClaimedBy;
	/**
	 * listing closed This indicates weather the donation has been picked up by the volunteer.
	 * @var bool $listingClosed
	 **/
	private $listingClosed;
	/**
	 * this is the estimated cost of the donations entered by the giving organization
	 * @var float $listingCost
	 **/
	private $listingCost;
	/**
	 * this is an memo area extra information about the donation being listed
	 * @var string $listingMemo
	 **/
	private $listingMemo;
	/**
	 * Pulled from the listing Id of the first time a message is sent
	 * @var int $listingParentId
	 **/
	private $listingParentId;
	/**
	 * This is the time that the listing was created, in a PHP DateTime object
	 * @var DateTime $listingPostTime
	 **/
	private $listingPostTime;
	/**
	 *This is a listing type for the donation. It'll be a dropdown with things like perishable, non perishable, refrigerated
	 * @var string $listingTypeId
	 **/
	private $listingTypeId;

	/**
	 * constructor for this listing
	 *
	 * @param mixed $newListingId new value of listing id
	 * @param int $newOrgId new value of organization id
	 * @param int $newListingClaimedBy new value of listing claimed by
	 * @param bool $newListingClosed
	 * @param float $newListingCost a value for the estimated cost of the donation
	 * @param string $newListingMemo new value of  listing memo
	 * @param mixed $newListingParentId new value of Listing parent id
	 * @param mixed $newListingPostTime listing post time as a DateTime object or string (or null to load the current time)
	 * @param int $newListingTypeId new value of listing type
	 * @throws InvalidArgumentException if data types are not valid
	 * @throws RangeException is data values are out of bounds (e.g., strings too long, negative integers)
	 * @throws Exception is some other exception is thrown
	 **/
	public function __construct($newListingId, $newOrgId, $newListingClaimedBy, $newListingClosed, $newListingCost, $newListingMemo, $newListingParentId, $newListingPostTime, $newListingTypeId = null) {
		try {
			$this->setListingId($newListingId);
			$this->setOrgId($newOrgId);
			$this->setListingClaimedBy($newListingClaimedBy);
			$this->setListingClosed($newListingClosed);
			$this->setListingCost($newListingCost);
			$this->setListingMemo($newListingMemo);
			$this->setListingParentId($newListingParentId);
			$this->setListingPostTime($newListingPostTime);
			$this->setListingTypeId($newListingTypeId);
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
	 * accessor method for listing id
	 *
	 * @return mixed value for listing id
	 **/
	public
	function getListingId() {
		return ($this->listingId);
	}

	/**
	 * mutator method for listing id
	 *
	 * @param mixed $newListingId new value of listing id
	 * @throws InvalidArgumentException if $newListingId is not an integer
	 * @throws RangeException is $newListingId is not positive
	 **/
	public
	function setListingId($newListingId) {
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
	public
	function getOrgId() {
		return ($this->orgId);
	}

	/**
	 * mutator method for organization id
	 *
	 * @param int $newOrgId new value of organization id
	 * @throws InvalidArgumentException if $newOrgId is not an integer or not positive
	 * @throws RangeException if $newOrgId is not positive
	 **/
	public
	function setOrgId($newOrgId) {
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
	 * accessor method for listing claimed by. This is the volId of the volunteer that claims the donation
	 *
	 * @return mixed value of listing claimed by
	 **/
	public
	function getListingClaimedBy() {
		return ($this->listingClaimedBy);
	}

	/**
	 * mutator method for listing claimed by.
	 *
	 * @param int $newListingClaimedBy new value of listing claimed by
	 * @throws InvalidArgumentException if $newListingClaimedBy is not an integer or not positive
	 * @throws RangeException if $newClaimedBy is not positive
	 **/
	public
	function setListingClaimedBy($newListingClaimedBy) {
		//verify the listing claimed by number is valid
		$newListingClaimedBy = filter_var($newListingClaimedBy, FILTER_VALIDATE_INT);
		if($newListingClaimedBy === false) {
			throw(new InvalidArgumentException("listing claimed by is not a valid integer"));
		}

		//verify the listing claimed by is positive
		if($newListingClaimedBy <= 0) {
			throw(new RangeException("listing claimed by is not positive"));
		}

		//convert and store the listing claimed by
		$this->listingClaimedBy = intval($newListingClaimedBy);
	}

	/**
	 * accessor method for Listing Closed
	 *
	 * @return bool value of listing closed
	 *
	 * QUESTION: have this looked over
	 **/
	public
	function getListingClosed() {
		return ($this->listingClosed);
	}

	/**
	 * mutator method for listing closed
	 *
	 * @param bool $newListingClosed
	 * @throws InvalidArgumentException if $newListingClosed is not a bool or insecure
	 **/
	public
	function setListingClosed($newListingClosed) {
		//verify the listing closed is valid
		$newListingClosed = filter_var($newListingClosed, FILTER_VALIDATE_BOOLEAN);
		if($newListingClosed === false) {
			throw(new InvalidArgumentException("listing closed is not a valid boolean"));
		}

		//convert and store the listing closed
		$this->listingClosed = boolval($newListingClosed);
	}

	/**
	 * accessor method for listing cost
	 *
	 * @return float a decimal to represent listing cost
	 **/
	public
	function getListingCost() {
		return ($this->listingCost);
	}

	/**
	 * mutator method for listing cost
	 *
	 * @param float $newListingCost new value for the estimated cost of the donation
	 * @throws InvalidArgumentException if $newListingCost is not a valid float
	 * @throws RangeException if the $newListingCost is not positive
	 **/
	public
	function setListingCost($newListingCost) {
		//verify the cost is a valid float
		$newListingCost = filter_var($newListingCost, FILTER_VALIDATE_FLOAT);
		if(empty($newListingCost) === true) {
			throw (new InvalidArgumentException ("listing cost is not a valid float"));
		}

		//verify the listing cost is positive
		if($newListingCost <= 0) {
			throw(new RangeException("listing cost is not positive"));
		}

		//convert and store the listing cost
		$this->listingCost = floatval($newListingCost);
	}

	/**
	 * accessor method for listing memo
	 *
	 * @return string value of listing memo
	 **/
	public
	function getListingMemo() {
		return ($this->listingMemo);
	}

	/**
	 *mutator method for listing memo
	 *
	 * @param string $newListingMemo new value of  listing memo
	 * @throws InvalidArgumentException if $newListingMemo is not a string or insecure
	 * @throws RangeException if $newListingMemo is > 256 characters
	 **/
	public
	function setListingMemo($newListingMemo) {
		//verify the listing memo is secure
		$newListingMemo = trim($newListingMemo);
		$newListingMemo = filter_var($newListingMemo, FILTER_SANITIZE_STRING);
		if(empty($newListingMemo) === true) {
			throw(new InvalidArgumentException("listing memo is empty or insecure"));
		}
		//verify the listing memo will fit in the database
		if(strlen($newListingMemo) > 256) {
			throw(new RangeException("listing memo is longer than 256 characters"));
		}

		//store the listing memo
		$this->listingMemo = $newListingMemo;
	}

	/**
	 * accessor method for listing parent id. this will be used if the listing is resent
	 *
	 * @return mixed value of listing parent id
	 **/
	public
	function getListingParentId() {
		return ($this->listingParentId);
	}

	/**
	 * mutator method for listing parent id
	 *
	 * @param mixed $newListingParentId new value of Listing parent id
	 * @throws InvalidArgumentException if $newListingParentId is not an integer
	 * @throws RangeException is $newListingParentId is not positive
	 **/
	public
	function setListingParentId($newListingParentId) {
		//verify the ListingParentId is valid
		$newListingParentId = filter_var($newListingParentId, FILTER_VALIDATE_INT);
		if($newListingParentId === false) {
			throw(new InvalidArgumentException("listing parent id is not a valid integer"));
		}
		//verify the ListingParentId is positive
		if($newListingParentId <= 0) {
			throw(new RangeException("listing parent id is not positive"));
		}

		//convert and store the listing id
		$this->listingParentId = intval($newListingParentId);
	}

	/**
	 *accessor method for listing post time listingPostTime
	 *
	 * @return DateTime value of listing post time
	 **/
	public
	function getListingPostTime() {
		return ($this->listingPostTime);
	}

	/**
	 * mutator method for listing post time
	 *
	 * @param mixed $newListingPostTime listing post time as a DateTime object or string (or null to load the current time)
	 * @throws InvalidArgumentException if $newListingPostTime is not a valid object or string
	 * @throws RangeException if $newListingPostTime is a date that does not exist
	 **/
	public function setListingPostTime($newListingPostTime) {
		//base case: if the date is null, use the current date and time
		if($newListingPostTime === null) {
			$this->listingPostTime = new DateTime();
			return;
		}

		//store the listing post time
		try {
			$newListingPostTime = Listing::validateDate($newListingPostTime);
		} catch(InvalidArgumentException $invalidArgument) {
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			throw(new RangeException($range->getMessage(), 0, $range));
		}
		$this->listingPostTime = $newListingPostTime;
	}

	/**
	 * accessor method for listing type
	 *
	 * @returns int value of listing type
	 **/
	public
	function getListingTypeId() {
		return ($this->listingTypeId);
	}

	/**
	 * mutator method for listing type
	 *
	 * @param int $newListingTypeId new value of listing type
	 * @throws InvalidArgumentException if $newListingTypeId is not an integer or not positive
	 * @throws RangeException if $newListingTypeId is not positive
	 **/
	public
	function setListingTypeId($newListingTypeId) {
		//verify the listing type is valid
		$newListingTypeId = filter_var($newListingTypeId, FILTER_VALIDATE_INT);
		if($newListingTypeId === false) {
			throw(new InvalidArgumentException("listing type is not a valid integer"));
		}

		//verify the listing type is positive
		if($newListingTypeId <= 0) {
			throw(new RangeException("list type is not positive"));
		}

		//convert and store the listing type
		$this->listingTypeId = intval($newListingTypeId);
	}

	/**
	 * function to store multiple database results into an SplFixedArray
	 *
	 * @param PDOStatement $statement pdo statement object
	 * @return SPLFixedArray all listings obtained from database
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function storeSQLResultsInArray(PDOStatement $statement) {
//build an array of listings, as an SPLFixedArray object
//set the size of the object to the number of retrieved rows
		$retrievedListings = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);

//while rows can still be retrieved from the result
		while(($row = $statement->fetch()) !== false) {
			try {
				$listing = new Listing($row["listingId"], $row["orgId"], $row["listingClaimedBy"], $row["listingClosed"], $row["listingCost"], $row["listingMemo"], $row["listingParentId"], $row["listingPostTime"], $row["listingTypeId"]);

//place result in the current field, then advance the key
				$retrievedListings[$retrievedListings->key()] = $listing;
				$retrievedListings->next();
			} catch(Exception $exception) {
//rethrow the exception if retrieval failed
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $retrievedListings;
	}

	/**
	 * inserts this listing into mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @throws PDO Exception when mySQL related errors occur
	 **/
	public function insert(PDO $pdo) {
		//enforce the listingId is null (i.e., don't insert a listing id that already exists)
		if($this->listingId !== null) {
			throw(new PDOException("not a new listing"));
		}
		//create query template
		$query = "INSERT INTO listing(listingId,orgId,listingClaimedBy,listingClosed,listingCost,listingMemo,listingParentId,listingPostTime,listingTypeId)VALUES(:listingId,:orgId,:listingClaimedBy,:listingClosed,:listingCost,:listingMemo,:listingParentId,:listingPostTime,:listingTypeId)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$formattedDate = $this->listingPostTime->format("Y-m-d H:i:s");
		$parameters = array("listingId" => $this->listingId, "orgId" => $this->orgId, "listingClaimedBy" => $this->listingClaimedBy, "listingClosed" => $this->listingClosed, "listingCost" => $this->listingCost, "listingMemo" => $this->listingMemo, "listingParentId" => $this->listingParentId, "listingPostTime" => $formattedDate, "listingTypeId" => $this->listingType);
		$statement->execute($parameters);

		//update the null listingId with what mySQL just gave us
		$this->listingId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this listing in mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @throws PDO Exception when mySQL related errors occur
	 **/
	public
	function delete(PDO $pdo) {
		//enforce the listing id is not null (i.e., don't delete a listing that hasn't been inserted)
		if($this->listingId === null) {
			throw(new PDOException("unable to delete a listing that does not exist"));
		}

		//create query template
		$query = "DELETE FROM listing WHERE listingId = :listingId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = array("listingId" => $this->listingId);
		$statement->execute($parameters);
	}

	/**
	 * updates this listing in mySQL
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @throws PDOException when mySQL related errors occur
	 **/
	public
	function update(PDO $pdo) {
		//enforce the listingId is not null (i.e., don't update a listing that hasn't been inserted)
		if($this->listingId === null) {
			throw(new PDOException("unable to update a listing that does not exist"));
		}
		//create query template
		$query = "UPDATE listing SET orgId = :orgId,listingClaimedBy = :listingClaimedBy,listingClosed = :listingClosed,listingCost = :listingCost,listingMemo = :listingMemo,listingParentId = :listingParentId,listingPostTime = :listingPostTime,listingTypeId = :listingTypeId WHERE listingId = :listingId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$formattedDate = $this->listingPostTime->format("Y-m-d H:i:s");
		$parameters = array("orgId" => $this->orgId, "listingClaimedBy" => $this->listingClaimedBy, "listingClosed" => $this->listingClosed, "listingCost" => $this->listingCost, "listingMemo" => $this->listingMemo, "listingParentId" => $this->listingParentId, "listingPostTime" => $formattedDate, "listingType" => $this->listingType, "listingId" => $this->listingId);
		$statement->execute($parameters);
	}

	/**
	 * gets the listing by orgId
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @param int $orgId organization id to search for
	 * @return mixed listing found or null if not found
	 * @throws PDO Exceptions when my SQL related errors occur
	 **/
	public static function getListingByOrgId(PDO $pdo, $orgId) {
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
		$query = "SELECT listingId,orgId,listingClaimedBy,listingClosed,listingCost,listingMemo,listingParentId,listingPostTime,listingTypeId FROM listing WHERE orgId = :orgId";
		$statement = $pdo->prepare($query);

		//bind the organization id to the place holder in the template
		$parameters = array("orgId" => $orgId);
		$statement->execute($parameters);

		//grab the listing from mySQL
		try {
			$listing = null;
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$listing = new listing($row["listingId"], $row["orgId"], $row["listingClaimedBy"], $row["listingClosed"], $row["listingCost"], $row["listingMemo"], $row["listingParentId"], $row["listingPostTime"], $row["listingType"]);
			}
		} catch(Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return ($listing);
	}

	/**
	 * gets the listing by listingParentId
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @param int $listingParentId listing parent id to search for
	 * @return mixed listing found or null if not found
	 * @throws PDO Exceptions when my SQL related errors occur
	 **/
	public static function getListingByParentId(PDO $pdo, $listingParentId) {
		//sanitize the listingParentId before searching
		$listingParentId = filter_var($listingParentId, FILTER_VALIDATE_INT);
		if($listingParentId === false) {
			throw(new PDOException("listing parent id is not a valid integer"));
		}

		//verify the organization id is positive
		if($listingParentId <= 0) {
			throw(new PDOException("listing parent id is not positive"));
		}
		//create query template
		$query = "SELECT listingId,orgId,listingClaimedBy,listingClosed,listingCost,listingMemo,listingParentId,listingPostTime,listingTypeId FROM listing WHERE listingParentId = :listingParentId";
		$statement = $pdo->prepare($query);

//bind the name value to the placeholder in the template
		$parameters = array("listingParentId" => $listingParentId);
		$statement->execute($parameters);

//call the function to build an array of the retrieved results
		try {
			$retrievedListings = Listing::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedListings;
	}

	/**
	 * gets the listing by listing post time
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @param int $listingPostTime listing post time to search for
	 * @return mixed listing found or null if not found
	 * @throws PDO Exceptions when my SQL related errors occur
	 * QUESTION: does this make sense if we are new searching within a range? No one would know the exact time a listing is posted REVIEW CAREFULLY
	 **/
	public static function getListingByListingPostTime(PDO $pdo, $listingPostTime) {
		//sanitize the listingPostTime before searching
		try {
			$listingPostTime = Listing::validateDate($listingPostTime);
		} catch(InvalidArgumentException $invalidArgument) {
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			throw(new RangeException($range->getMessage(), 0, $range));
		}

		//create query template
		$query = "SELECT listingId,orgId,listingClaimedBy,listingClosed,listingCost,listingMemo,listingParentId,listingPostTime,listingTypeId FROM listing WHERE listingPostTime = :listingPostTime";
		$statement = $pdo->prepare($query);

		//bind the name value to the placeholder in the template
		$parameters = array("listingPostTime" => $listingPostTime);
		$statement->execute($parameters);

		//call the function to build an array of the retrieved results
		try {
			$retrievedListings = Listing::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedListings;
	}

	/**
	 * gets the listing by listingTypeId
	 *
	 * @param PDO $pdo pointer to PDO connection
	 * @param int $listingTypeId listing type id to search for
	 * @return mixed listing found or null if not found
	 * @throws PDO Exceptions when my SQL related errors occur
	 **/
	public static function getListingByTypeId(PDO $pdo, $listingTypeId) {
		//sanitize the listingTypeId before searching
		$listingTypeId = filter_var($listingTypeId, FILTER_VALIDATE_INT);
		if($listingTypeId === false) {
			throw(new PDOException("listing type id is not a valid integer"));
		}

		//verify the listing type id is positive
		if($listingTypeId <= 0) {
			throw(new PDOException("listing type id is not positive"));
		}

		//create query template
		$query = "SELECT listingId,orgId,listingClaimedBy,listingClosed,listingCost,listingMemo,listingParentId,listingPostTime,listingTypeId FROM listing WHERE listingTypeId = :listingTypeId";
		$statement = $pdo->prepare($query);

		//bind the name value to the placeholder in the template
		$parameters = array("listingTypeId" => $listingTypeId);
		$statement->execute($parameters);

		//call the function to build an array of the retrieved results
		try {
			$retrievedListings = Listing::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedListings;
	}

	/**
	 * retrieves all listings
	 *
	 * @param PDO $pdo pdo connection object
	 * @return SplFixedArray all listings
	 * @throws PDOException if mySQL errors occur
	 */
	public static function getAllListings(PDO $pdo) {

		//create query template
		$query = "SELECT listingId,orgId,listingClaimedBy,listingClosed,listingCost,listingMemo,listingParentId,listingPostTime,listingTypeId FROM listing";
		$statement = $pdo->prepare($query);
		$statement->execute();

		///call the function to build an array of the retrieved results
		try {
			$retrievedListings = Listing::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedListings;
	}
}
