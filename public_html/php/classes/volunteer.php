<?php

/**
 * Volunteer is a small user attached to a receiving organization. They do not have access to the organization profile
 * They receive notifications about donations and have the ability to claim donations and pickup donations. They are managed
 * by the admin of the organization they're associated with.
 *
 * @author Kimberly Keller <kimberly@gravitaspublications.com>
 **/

class Volunteer {
	/**
	 * id for this Volunteer; this is the primary key
	 * @var int $volId
	 **/
	private $volId;
	/**
	 * id of the Organization that this Volunteer is associated with; this is a foreign key
	 * @var int $orgId
	 **/
	private $orgId;
	/**
	 * email the Volunteer is associated with
	 * @var string $volEmail
	 **/
	private $volEmail;
	/**
	 * activation key for Volunteer email, null if email confirmed
	 * @var int $volEmailActivation
	 **/
	private $volEmailActivation;
	/**
	 * first name of Volunteer
	 * @var string $volFirstName
	 **/
	private $volFirstName;
	/**
	 * last name of Volunteer
	 * @var string $volLastName
	 **/
	private $volLastName;
	/**
	 * phone number for Volunteer
	 * @var string $volPhone
	 **/
	private $volPhone;

	/**
	 * constructor for this Volunteer
	 *
	 * @param mixed $newVolId id of this Volunteer or null if new Volunteer
	 * @param int $newOrgId id of the Organization that is associated with this Volunteer
	 * @param string $newVolEmail email of the Volunteer
	 * @param int $newVolEmailActivation activation key for Volunteer email, null if email confirmed
	 * @param string $newVolFirstName string containing first name of the Volunteer
	 * @param string $newVolLastName string containing last name of the Volunteer
	 * @param string $newVolPhone string containing the US phone number associated with the Volunteer
	 **/
	public function __construct($newVolId, $newOrgId, $newVolEmail, $newVolEmailActivation, $newVolFirstName, $newVolLastName, $newVolPhone) {
		try {
			$this->setVolId($newVolId);
			$this->setOrgId($newOrgId);
			$this->setVolEmail($newVolEmail);
			$this->setVolEmailActivation($newVolEmailActivation);
			$this->setVolFirstName($newVolFirstName);
			$this->setVolLastName($newVolLastName);
			$this->setVolPhone($newVolPhone);

		} catch(InvalidArgumentException $invalidArugument) {
			//rethrow the exception to the caller
			throw(new InvalidArgumentException($invalidArugument->getMessage(),0, $invalidArugument));

		} catch(RangeException $range) {
			//rethrow the exception to the caller
			throw(new RangeException($range->getMessage(), 0, $range));

		} catch(Exception $exception) {
			//rethrow generic exception
			throw(new Exception($exception->getMessage(), 0, $exception));
		}
	}

	/**
	 * accessor method for volunteer id
	 *
	 * @return mixed value for volunteer id
	 **/
	public function getVolId() {
		return($this->volId);
	}

	/**
	 * mutator method for volunteer id
	 *
	 * @param mixed $newVolId new value of volunteer id
	 * @throws InvalidArgumentException if $newVolId is not an integer
	 * @throws RangeException if $newVolId is not positive
	 **/
	public function setVolId($newVolId) {

		//base case: if the vol id is null, this is a new volunteer without a mySQL assigned id
		if($newVolId === null) {
			$this->volId = null;
			return;
		}

		//verify the vol id is valid
		$newVolId = filter_var($newVolId, FILTER_VALIDATE_INT);
		if($newVolId === false) {
			throw(new InvalidArgumentException("this volunteer id is not a valid integer"));
		}

		//verify the vol id is positive
		if($newVolId <= 0) {
			throw(new RangeException("this volunteer id is not positive"));
		}

		//convert and store the vol id
		$this->volId = intval($newVolId);
	}

	/**
	 * accessor method for org id
	 *
	 * @return int value of org id
	 **/
	public function getOrgId() {
		return($this->orgId);
	}

	/**
	 * mutator method for org id
	 *
	 * @param int $newOrgId new value of org id
	 * @throws InvalidArgumentException if $newOrgId is not an integer or postive
	 * @throws RangeException if $newOrgId is not positive
	 **/
	public function setOrgId($newOrgId) {

		//verify the org id is valid
		$newOrgId = filter_var($newOrgId, FILTER_VALIDATE_INT);
		if($newOrgId === false) {
			throw(new InvalidArgumentException("org id is not a valid integer"));
		}

		//verify the org id is positive
		if($newOrgId <= 0) {
			throw(new RangeException("org id is not positive"));
		}

		//convert and store the org id
		$this->orgId = intval($newOrgId);
	}

	/**
	 * accessor method for vol email
	 *
	 * @return string value of vol email
	 **/
	public function getVolEmail() {
		return($this->volEmail);
	}

	/**
	 * mutator method for vol email
	 *
	 * @param string $newVolEmail new volunteer email
	 * @throws InvalidArgumentException if $newVolEmail is not a string or insecure
	 * @throws RangeException if $newVolEmail is > 128 characters
	 **/
	public function setVolEmail($newVolEmail) {

		//verify the email is secure
		$newVolEmail = trim($newVolEmail);
		$newVolEmail = filter_var($newVolEmail, FILTER_SANITIZE_EMAIL);
		if(empty($newVolEmail) === true) {
			throw(new InvalidArgumentException("email is empty or insecure"));
		}

		//verify the email will fit in the database
		if(strlen($newVolEmail) > 128) {
			throw(new RangeException("email is too long"));
		}

		//store the email address
		$this->volEmail = $newVolEmail;
	}

	/**
	 * accessor for vol email activation code
	 *
	 * @return string value of activation code
	 **/
	public function getVolEmailActivation() {
		return($this->volEmailActivation);
	}

	/**
	 * mutator for vol email activation code
	 *
	 * @param string $newVolEmailActivation
	 * @throws InvalidArgumentException if activation code is not a string or insecure
	 **/
	public function setVolEmailActivation($newVolEmailActivation) {

		//verify the activation code is valid
		$newVolEmailActivation = filter_var($newVolEmailActivation, FILTER_SANITIZE_STRING);
		if(strlen($newVolEmailActivation) < 16) {
			throw(new InvalidArgumentException("activation code is insufficient length or insecure"));
		}

		//verify the code will fit in the database
		if(strlen($newVolEmailActivation) > 16) {
			throw(new RangeException("activation code is too large"));
		}

		//store activation code
		$this->volEmailActivation = $newVolEmailActivation;
	}

	/**
	 * accessor method for volunteer first name
	 *
	 * @return string value for first name
	 **/
	public function getVolFirstName() {
		return($this->volFirstName);
	}

	/**
	 * mutator method for volunteer first name
	 *
	 * @param string $newVolFirstName new first name of a volunteer
	 * @throws InvalidArgumentException if $newVolFirstName is not a string or insecure
	 * @throws RangeException if $newVolFirstName is too large
	 **/
	public function setVolFirstName($newVolFirstName) {
		//verify this first name is secure
		$newVolFirstName = trim($newVolFirstName);
		$newVolFirstName = filter_var($newVolFirstName, FILTER_SANITIZE_STRING);
		if(empty($newVolFirstName) === true) {
			throw(new InvalidArgumentException("first name empty or insecure"));
		}

		//verify the first name will fit in the database
		if(strlen($newVolFirstName) > 32) {
			throw(new RangeException("first name is too long"));
		}

		//store the first name
		$this->volFirstName = $newVolFirstName;
	}

	/**
	 * accessor method for vol last name
	 *
	 * @returns string value of last name
	 **/
	public function getVolLastName() {
		return($this->volLastName);
	}

	/**
	 * mutator method for vol last name
	 *
	 * @param string $newVolLastName new value of last name
	 * @throws InvalidArgumentException if $newVolLastName is not a string or insecure
	 * @throws RangeException if $newVolLastName if last name is more than 32 char
	 **/
	public function setVolLastName($newVolLastName) {
		//verify the last name is secure
		$newVolLastName = trim($newVolLastName);
		$newVolLastName = filter_var($newVolLastName, FILTER_SANITIZE_STRING);
		if(empty($newVolLastName) === true) {
			throw(new InvalidArgumentException("last name is empty or insecure"));
		}

		//verify the last name will fit in the database
		if(strlen($newVolLastName) > 32) {
			throw(new RangeException("last name is too long"));
		}

		//store the last name
		$this->volLastName = $newVolLastName;
	}

	/**
	 * accessor for vol phone
	 *
	 * @returns string value of phone number
	 **/
	public function getVolPhone() {
		return($this->volPhone);
	}

	/**
	 * mutator for vol phone
	 *
	 * @param string $newVolPhone
	 * @throws InvalidArgumentException if $$newVolPhone is not a string or insecure
	 * @throws RangeException if $newVolPhone is more than 32 characters
	**/
	public function setVolPhone($newVolPhone) {
		//verify that the phone number is secure
		$newVolPhone = trim($newVolPhone);
		$newVolPhone = filter_var($newVolPhone, FILTER_SANITIZE_STRING);
		if(empty($newVolPhone) === true) {
			throw(new InvalidArgumentException("phone number is empty or insecure"));
		}

		//verify the phone number will fit in the database
		if(strlen($newVolPhone) > 32) {
			throw(new RangeException("phone number is too long"));
		}

		//store the phone number
		$this->volPhone = $newVolPhone;
	}

	/**
	 * inserts this Volunteer into mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDO exception when mySQL related errors occur
	 **/
	public function insert(PDO $pdo) {
		//enforce the volID is null (don't insert a volunteer that already exists)
		if($this->volId !== null) {
			throw (new PDOException("not a new volunteer"));
		}

		//create query template
		$query = "INSERT INTO volunteer(orgId,volEmail, volEmailActivation, volFirstName, volLastName, volPhone) VALUES(:orgId, :volEmail, :volEmailActivation, :volFirstName, :volLastName, :volPhone)";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = array("orgId" => $this->orgId, "volEmail" => $this->volEmail, "volEmailActivation" => $this->volEmailActivation, "volFirstName" => $this->volFirstName, "volLastName" => $this->volLastName, "volPhone" => $this->volPhone);
		$statement->execute($parameters);

		//update the null volId with what mySQL just gave us
		$this->volId = intval($pdo->lastInsertId());
	}

	/**
	 * deletes this volunteer from mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDO exception when mySQL related errors occur
	 **/
	public function delete(PDO $pdo) {
		//enforce that the volId is not null (don't delete a volunteer that hasn't been inserted)
		if($this->volId === null) {
			throw(new PDOException("unable to delete a volunteer that does not exist"));
		}

		//create query tempalte
		$query = "DELETE FROM volunteer WHERE volId = :volId";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holder in the template
		$parameters = array("volId" => $this->volId);
		$statement->execute($parameters);
	}

	/**
	 * update this volunteer in mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throws PDOException when mySQL related errors occure
	 **/
	public function update(PDO $pdo) {
		//enforce the volID is not null (don't update a volunteer that hasn't been inserted)
		if($this->volId === null) {
			throw(new PDOException("unable to update a volunteer that doesn not exist"));
		}

		//create query tempalte
		$query = "UPDATE volunteer SET orgId = :orgId, volEmail = :volEmail, volEmailActivation =:volEmailActivation, volFirstName = :volFirstName, volLastName = :volLastName, volPhone = :volPhone";
		$statement = $pdo->prepare($query);

		//bind the member variables to the place holders in the template
		$parameters = array("orgId" => $this->orgId, "volEmail" => $this->volEmail, "volEmailActivation" => $this->volEmailActivation, "volFirstName" => $this->volFirstName, "volLastName" => $this->volLastName, "volPhone" => $this->volPhone);
		$statement->execute($parameters);
	}

	/**
	 * gets volunteer by volId
	 *
	 * @param PDO $pdo PDO connection object
	 * @param int $volId the volunteer id to search for
	 * @return mixed volunteer found or null if not found
	 * @throws PDOexception when mySQL related errors occur
	 **/
	public static function getVolunteerByVolId(PDO $pdo, $volId) {
		//sanitize the volId before searching
		$volId = filter_var($volId, FILTER_VALIDATE_INT);
		if($volId === false) {
			throw(new PDOException("volunteer id is not an integer"));
		}
		if($volId <= 0) {
			throw(new PDOException("volunteer id is not positive"));
		}

		//create query template
		$query = "SELECT volId, orgId, volEmail, volEmailActivation, volFirstName, volLastName, volPhone FROM volunteer WHERE volId = :volId";
		$statement = $pdo->prepare($query);

		//bind the volunteer id to the place holder in the template
		$parameters = array("volId" => $volId);
		$statement->execute($parameters);

		//grab the volunteer from mySQL
		try {
			$volunteer = null;
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$volunteer = new Volunteer($row["volId"], $row["orgId"], $row["volEmail"], $row["volEmailActivation"], $row["volFirstName"], $row["volLastName"], $row["volPhone"]);
			}
		} catch(Exception $exception) {
			//if the row couldn't be converted, rethrow it
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return($volunteer);
	}

	/**
	 * function to store multiple database results into an SplFixedArray
	 *
	 * @param PDOStatement $statement pdo statement object
	 * @return SplFixedArray all volunteers obtained from databse
	 * @throws PDOException if mySQL related errors occur
	 **/
	public static function storeSQLResultsInArray(PDOStatement $statement) {
		//build an array of volunteers as an SplFixedArray object
		//set the size of the object to the number of retrieved rows
		$retrievedVol = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);

		//while rows can still be retrieved from the result
		while(($row = $statement->fetch()) !== false) {
			try {
				$volunteer = new Volunteer($row["volId"], $row["ordId"], $row["volEmail"], $row["volEmailActivation"],
						$row["volFirstName"], $row["volLastName"], $row["volPhone"]);
				//place result in the current field, then advance the key
				$retrievedVol[$retrievedVol->key()] = $volunteer;
				$retrievedVol->next();
			} catch(Exception $exception) {
				//rethrow the exception if retrieval failed
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $retrievedVol;
	}

	/**
	 * get volunteer by organization id
	 *
	 * @param PDO $pdo pdo connection object
	 * @param int $orgId organization this volunteer is associated with
	 * @return SplFixedArray all volunteers found for this content
	 * @throws PDOException if mySQL related errors occur
	 **/
	public static function getVolunteerByOrgId(PDO $pdo, $orgId) {
		//sanitize the input
		$orgId = filter_var($orgId, FILTER_VALIDATE_INT);
		if($orgId === false) {
			throw(new PDOException("org id is not an integer"));
		}
		if($orgId <= 0) {
			throw(new PDOException("org id is not positive"));
		}

		//create query template
		$query = "SELECT volId, volEmail, volFirstName, volLastName, volPhone FROM volunteer WHERE orgId = :orgId ";
		$statement = $pdo->prepare($query);

		//bind the id value to the placeholder in the template
		$orgId = $orgId;
		$parameters = array("orgId" => $orgId);
		$statement->execute($parameters);

		//call the function to build and array of the retrieved values
		try {
			$retrievedVol = Volunteer::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if the retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedVol;
	}

	/**
	 * get volunteer by email
	 *
	 * @param PDO $pdo pdo connection object
	 * @param string $volEmail email this volunteer is associated with
	 * @return SplFixedArray all volunteers found for this content
	 * @throws PDOException if mySQL related errors occur
	 **/
	public static function getVolunteerByVolEmail(PDO $pdo, $volEmail) {
		//sanitize the input
		$volEmail = trim($volEmail);
		$volEmail = filter_var($volEmail, FILTER_SANITIZE_EMAIL);
		if(empty($volEmail) === true) {
			throw (new PDOException("email is empty or insecure"));
		}

		//create query template
		$query = "SELECT volId, orgId, volFirstName, volLastName, volPhone FROM volunteer WHERE volEmail = :volEmail ";
		$statement = $pdo->prepare($query);

		//bind the id value to the placeholder in the template
		$volEmail = $volEmail;
		$parameters = array("volEmail" => $volEmail);
		$statement->execute($parameters);

		//call the function to build and array of the retrieved values
		try {
			$retrievedVol = Volunteer::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if the retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedVol;
	}








}

