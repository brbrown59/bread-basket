<?php

/**
 * an enumerator for listing types
 *
 * This class enumerates all of the different listing types needed by the listing class
 * it contains only a listing type and a listing type ID
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 */

class ListingType {

	/**
	 * id for the listing type: this is the primary key
	 * @var int $listingTypeId
	 */
	private $listingTypeId;

	/**
	 * the information about the listing type
	 * @var String $listingTypeInfo;
	 */
	private $listingTypeInfo;

	/**
	 * accessor method for the listing type id
	 *
	 * @return mixed value of listing type id
	 */
	public function getListingTypeId() {
		return($this->listingTypeId);
	}

	/**
	 * ListingType constructor.
	 * @param $newListingTypeId
	 * @param $newListingTypeInfo
	 * @throws InvalidArgumentException if data types are invalid or insecure
	 * @throws RangeException if data values are out of bounds
	 * @throws Exception if some other exception is thrown
	 */

	public function __construct($newListingTypeId, $newListingTypeInfo) {
		try {
			$this->setListingTypeId($newListingTypeId);
			$this->setListingTypeInfo($newListingTypeInfo);
			//rethrow any exceptions to their callers
		} catch(InvalidArgumentException $invalidArgument) {
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));
		} catch(RangeException $range) {
			throw(new RangeException($range->getMessage(), 0, $range));
		} catch(Exception $exception) {
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * mutator method for the listing type id
	 *
	 * @param mixed $newListingTypeId new value of the listing type id
	 * @throws InvalidArgumentException if $newListingTypeId is not an integer
	 * @throws RangeException if $newListingTypeId is not positive
	 */
	public function setListingTypeId($newListingTypeId) {
		//if the listing type id is null, this is a new listing type not in mySQL; temporarily set it to null
		if($newListingTypeId === null) {
			$this->listingTypeId = null;
			return;
		}

		//verify the id is a valid integer
		$newListingTypeId = filter_var($newListingTypeId, FILTER_VALIDATE_INT);
		if($newListingTypeId === false) {
			throw(new InvalidArgumentException("listing type id is not a valid integer"));
		}

		//verify the id is positive
		if($newListingTypeId <= 0) {
			throw(new RangeException("listing type id is not positive"));
		}

		//convert to int and store
		$this->listingTypeId = intval($newListingTypeId);
	}

	/**
	 * accessor method for the listing type information
	 *
	 * @return String value of listing type information
	 */
	public function getListingTypeInfo() {
		return($this->listingTypeId);
	}

	/**
	 * mutator method for the listing type id
	 *
	 * @param mixed $newListingTypeInfo new value of the listing type info
	 * @throws InvalidArgumentException if $newListingTypeInfo is not an integer
	 * @throws RangeException if $newListingTypeInfo is not positive
	 */
	public function setListingTypeInfo($newListingTypeInfo) {

		//verify the id is valid and secure
		$newListingTypeInfo = trim($newListingTypeInfo);
		$newListingTypeInfo = filter_var($newListingTypeInfo, FILTER_SANITIZE_STRING);
		if(empty($newListingTypeInfo) === true) {
			throw(new InvalidArgumentException("listing type is not valid or insecure"));
		}

		//verify the id is positive
		if(strlen($newListingTypeInfo) > 32) {
			throw(new RangeException("listing type is too large"));
		}

		//convert to int and store
		$this->listingTypeInfo = $newListingTypeInfo;
	}

	/**
	 * function to insert the new listing type into the database
	 *
	 * @param PDO $pdo pdo connection object
	 * @throws PDOException when mySQL related errors occur
	 */
	public function insert (PDO $pdo) {
		//if the listingTypeId is not null, this is not a new entry: don't insert into the database
		if($this->listingTypeId !== null) {
			throw(new PDOException("not a new organization"));
		}

		//create query template
		$query = "INSERT INTO listingType(listingTypeId, listingType) VALUES (:listingTypeId, :listingType)";
		$statement = $pdo->prepare($query);

		//bind member variables to the placeholders in the template
		$parameters = array("listingTypeId" => $this->listingTypeId, "listingType" => $this->listingTypeInfo);
		$statement->execute($parameters);

		//update the class with the mySQL-assigned id
		$this->listingTypeId = intval($pdo->lastInsertId());
	}

	/**
	 * function to delete a listing type from the database
	 *
	 * @param PDO $pdo pdo connection object
	 * @throws PDOException when mySQL related errors occur
	 */
	public function delete(PDO $pdo) {
		//ensure the listing type we are trying to delete exists in the database
		if($this->listingTypeId === null) {
			throw (new PDOException("unable to delete a listing type that does not exist"));
		}

		//create query template
		$query = "DELETE FROM listingType WHERE listingTypeId = :listingTypeId";
		$statement = $pdo->prepare($query);

		//bind the values to their placeholders in the template, and execute
		$parameters = array("listingTypeId" => $this->listingTypeId);
		$statement->execute($parameters);
	}

	public function update (PDO $pdo) {
		//ensure listing type is in the database
		if($this->listingTypeId === null) {
			throw(new PDOException("unable to update a listing type that does not exist"));
		}

		//create query template
		$query = "UPDATE listingType SET listingType = :listingType WHERE listingTypeId = :listingTypeId";
		$statement = $pdo->prepare($query);

		//bind member variables to the placeholders in the template
		$parameters = array("listingType" => $this->listingTypeInfo, "listingTypeId" => $this->listingTypeId);
		$statement->execute($parameters);
	}

	/**
	 * function to retrieve listing types by listing id
	 *
	 * @param PDO $pdo pdo connection object
	 * @param int $listingTypeId listingTypeId id to search for
	 * @return mixed organization if found or null if not found
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function getListingTypeById(PDO $pdo, $listingTypeId) {
		//verify that the id to search for is valid
		$listingTypeId = filter_var($listingTypeId, FILTER_VALIDATE_INT);
		if($listingTypeId === false) {
			throw new PDOException("listing type id is not an integer");
		}
		if($listingTypeId <= 0) {
			throw new PDOException("listing type is not positive");
		}

		//create query template
		$query = "SELECT listingTypeId, listingType FROM listingType WHERE listingTypeId = :listingTypeId";
		$statement = $pdo->prepare($query);

		//bind member variables to the placeholders in the template
		$parameters = array("listingTypeId" => $listingTypeId);
		$statement->execute($parameters);

		//grab result from mysql
		try {
			$listingType = null;
			//set fetch mode to retrieve the result as an array indexed by column name
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			//if fetch successful, store in a new object
			if($row !== false) {
				$listingType = new ListingType($row["listingTypeId"], $row["listingType"]);
			}
		} catch(Exception $exception) {
			//rethrow the exception if the retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $listingType;
	}

	/**
	 * retrieves all listingtypes
	 *
	 * @param PDO $pdo pdo connection object
	 * @return SplFixedArray all organizations
	 * @throws PDOException if mySQL errors occur
	 */
	public static function getAllListingTypes(PDO $pdo) {
		//create query template and execute
		$query = "SELECT listingTypeId, listingType FROM listingType";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//build an array of the retrieved results
		//set the size of the object to the number of retrieved rows
		$retrievedTypes = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);

		//while rows can still be retrieved from the result
		while(($row = $statement->fetch()) !== false) {
			try {
				$listingType = new ListingType($row["listingTypeId"], $row["listingTypeInfo"]);
				//place result in the current field, then advance the key
				$retrievedTypes[$retrievedTypes->key()] = $listingType;
				$retrievedTypes->next();
			} catch(Exception $exception) {
				//rethrow the exception if retrieval failed
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $retrievedTypes;
	}
}