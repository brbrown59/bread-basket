<?php
/**
*
* An organization profile for bread basket
*
* This is the class for an organization profile on bread basket
* It handles basic information about an organization such as their location, hours of operation, and the type of organization
*
* @author Bradley Brown <tall.white.ninja@gmail.com>
**/
class Organization{

	/**
	 * id for the organization: this is the primary key
	 * @var int $orgId;
 	**/
	private $orgId;

	/**
	 * the primary address info of the organization
	 * @var String $orgAddress1;
	 **/
	private $orgAddress1;

	/**
	 * the secondary address info of the organization
	 * @var String $orgAddress2;
	 **/
	private $orgAddress2;

	/**
	 * the city of the organization
	 * @var String $orgCity;
	 **/
	private $orgCity;

	/**
	 * a description of the organization
	 * @var String $orgDescription;
	 **/
	private $orgDescription;

	/**
	 * the listed hours of the organization
	 * @var String $orgHours
	 **/
	private $orgHours;

	/**
	 * the name of the organization
	 * @var String $orgName
	 **/
	private $orgName;

	/**
	 * the organization's phone number
	 * @var String $orgPhone
	 **/
	private $orgPhone;

	/**
	 * the organization's state
	 * @var String $orgState
	 **/
	private $orgState;

	/**
	 * a one character field flagging the type of organization
	 * @var String $orgType
	 **/
	private $orgType;

	/**
	 * the zip code of the organization
	 **/
	private $orgZip;

	/**
	 * constructor for the organization
	 *
	 * @param $newOrgId mixed the id of the organization, or null if a new organization
	 * @param $newAddress1 String the first line of the address of the organization
	 * @param $newAddress2 String the second line of the address of the organization
	 * @param $newCity String the city of the organization
	 * @param $newDescription String a description of the new organization
	 * @param $newHours String the hours of the organization
	 * @param $newName String the name of the organization
	 * @param $newPhone String the phone number of the organization
	 * @param $newState String the state of the organization
	 * @param $newType String the type of the organization
	 * @param $newZip String the zip code of the organization
	 * @throws InvalidArgumentException if data types are invalid or values are insecure
	 * @throws RangeException if data values are out of bounds
	 * @throws Exception if some other exception is thrown
	 */
	public function __construct($newOrgId, $newAddress1, $newAddress2, $newCity, $newDescription, $newHours, $newName, $newPhone, $newState, $newType, $newZip) {
		try {
			$this->setOrgId($newOrgId);
			$this->setOrgAddress1($newAddress1);
			$this->setOrgAddress2($newAddress2);
			$this->setOrgCity($newCity);
			$this->setOrgDescription($newDescription);
			$this->setOrgHours($newHours);
			$this->setOrgName($newName);
			$this->setOrgPhone($newPhone);
			$this->setOrgState($newState);
			$this->setOrgType($newType);
			$this->setOrgZip($newZip);
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
	 * accessor method for the organization id
	 *
	 * @return mixed value of organization id
	 **/
	public function getOrgId() {
		return($this->orgId);
	}

	/**
	 * mutator method for the organization id
	 *
	 * @param mixed $newOrgId new value of the organization id
	 * @throws InvalidArgumentException if $newOrgId is not an integer
	 * @throws RangeException if $newOrgId is not positive
	 **/
	public function setOrgId($newOrgId) {
		//if the org id is null, this is a new organization profile with no mySQL id; temporarily set the id to null
		if($newOrgId === null) {
			$this->orgId = null;
			return;
		}

		//verify the id is a valid integer
		$newOrgId =  filter_var($newOrgId, FILTER_VALIDATE_INT);
		if($newOrgId === false) {
			throw(new InvalidArgumentException("organization id is not a valid integer"));
		}

		//verify the id is positive
		if($newOrgId <= 0) {
			throw(new RangeException("organization id is not positive"));
		}

		//convert and store the new org id
		$this->orgId = intval($newOrgId);
	}

	/**
	 * accessor method for the first line of the organization address
	 *
	 * @return String value of organization address
	 */
	public function getOrgAddress1() {
		return($this->orgAddress1);
	}

	/**
	 * mutator method for the first line of the organization address
	 *
	 * @param String $newAddress1 new value of the organization address
	 * @throws InvalidArgumentException if $newAddress1 is not a string or is insecure
	 * @throws RangeException if $newAddress1 is larger than 64 characters
	 **/
	public function setOrgAddress1($newAddress1) {
		//verify the new address is secure
		$newAddress1 = trim($newAddress1);
		$newAddress1 = filter_var($newAddress1, FILTER_SANITIZE_STRING);
		if(empty($newAddress1) === true) {
			throw (new InvalidArgumentException("address (first line) is empty or insecure"));
		}

		//verify the new address will fit in the database
		if(strlen($newAddress1) > 64) {
			throw(new RangeException("address (first line) is too large"));
		}

		//store the new address
		$this->orgAddress1 = $newAddress1;
	}

	/**
	 * accessor method for the second line of the organization address
	 *
	 * @return String value of organization address
	 */
	public function getOrgAddress2() {
		return($this->orgAddress2);
	}

	/**
	 * mutator method for the second line of the organization address
	 *
	 * @param String $newAddress2 new value of the organization address
	 * @throws InvalidArgumentException if $newOrgAddress2 is not a string or is insecure
	 * @throws RangeException if $newOrgAddress2 is larger than 64 characters
	 **/
	public function setOrgAddress2($newAddress2) {
		//verify the new address is secure
		$newAddress2 = trim($newAddress2);
		$newAddress2 = filter_var($newAddress2, FILTER_SANITIZE_STRING);
		//allow the empty case
		if($newAddress2 === false) {
			throw (new InvalidArgumentException("address (second line) is insecure"));
		}
		//verify the new address will fit in the database
		if(strlen($newAddress2) > 64) {
			throw(new RangeException("address (second line) is too large"));
		}
		//store the new address
		$this->orgAddress2 = $newAddress2;
	}

	/**
	 * Accessor method for the organization city
	 * @return String value of organization city
	 */
	public function getOrgCity() {
		return ($this->orgCity);
	}

	/**
	 * Mutator method for the organization city
	 *
	 * @param String $newCity new name of the organization city
	 * @throws InvalidArgumentException if name of city is empty or insecure
	 * @throws RangeException if $newCity is too large for the database
	 */
	public function setOrgCity($newCity) {
		//make sure string is secure
		$newCity = trim($newCity);
		$newCity = filter_var($newCity, FILTER_SANITIZE_STRING);
		if(empty($newCity) === true) {
			throw new InvalidArgumentException("city name is empty or insecure");
		}
		//check the size of the string
		if(strlen($newCity) > 24) {
			throw new RangeException("city name is too large");
		}
		//store the new value
		$this->orgCity = $newCity;
	}

	/**
	 * accessor method for the organization description
	 *
	 * @return String value of organization description
	 */
	public function getOrgDescription() {
		return ($this->orgDescription);
	}

	/**
	 * mutator method for the organization description
	 *
	 * @param String $newDescription new description of the organization
	 * @throws InvalidArgumentException if $newDescription is insecure
	 * @throws RangeException if $newDescription is too large for the database
	 */
	public function setOrgDescription($newDescription) {
		//check that new description is secure
		$newDescription = trim($newDescription);
		$newDescription = filter_var($newDescription, FILTER_SANITIZE_STRING);
		if($newDescription === false) {
			throw new InvalidArgumentException("organization description is insecure");
		}

		//check that new description will fit in the database
		if(strlen($newDescription) > 255) {
			throw new RangeException("organization description is too large");
		}

		//store the new value
		$this->orgDescription = $newDescription;
	}

	/**
	 * accessor method for the organization hours
	 *
	 * @return String value of organization hours
	 */
	public function getOrgHours() {
		return ($this->orgHours);
	}

	/**
	 * mutator method for the listed organization hours
	 *
	 * @param String $newHours new hours of the organization
	 * @throws InvalidArgumentException if $newHours is insecure
	 * @throws RangeException if $newHours is too large for the database
	 */
	public function setOrgHours($newHours) {
		//check that new hours string is secure
		$newHours = trim($newHours);
		$newHours = filter_var($newHours, FILTER_SANITIZE_STRING);
		if($newHours === false) {
			throw new InvalidArgumentException("organization hours are insecure");
		}

		//check that new hours will fit in the database
		if(strlen($newHours) > 64) {
			throw new RangeException("organization hours are too large");
		}

		//store the new value
		$this->orgHours = $newHours;
	}

	/**
	 * accessor method for the organization name
	 *
	 * @return String value of organization name
	 */
	public function getOrgName() {
		return ($this->orgName);
	}

	/**
	 * mutator method for the organization name
	 *
	 * @param String $newName new Name of the organization
	 * @throws InvalidArgumentException if $newName is empty or insecure
	 * @throws RangeException if $newName is too large for the database
	 */
	public function setOrgName($newName) {
		//check that new name is not empty and secure
		$newName = trim($newName);
		$newName = filter_var($newName, FILTER_SANITIZE_STRING);
		if(empty($newName) === true) {
			throw new InvalidArgumentException("organization name is empty or insecure");
		}

		//check that new name will fit in the database
		if(strlen($newName) > 128) {
			throw new RangeException("organization name is too large");
		}

		//store the new value
		$this->orgName = $newName;
	}

	/**accessor method for organization phone number
	 *
	 * @return String value of organization phone number
	 */
	public function getOrgPhone() {
		return($this->orgPhone);
	}

	/**
	 * mutator method for the organization phone number
	 *
	 * @param String $newPhone new phone number of the organization
	 * @throws InvalidArgumentException if $newPhone is empty or insecure
	 * @throws RangeException if $newPhone is too large for the database
	 */
	public function setOrgPhone($newPhone) {
		//check that the phone number is secure and not empty
		$newPhone = trim($newPhone);
		$newPhone = filter_var($newPhone, FILTER_SANITIZE_STRING);
		if(empty($newPhone) === true) {
			throw new InvalidArgumentException("phone number is empty or insecure");
		}

		//check that the new phone number will fit in the database
		if(strlen($newPhone) > 32) {
			throw new RangeException("phone number is too large");
		}
		 //store the value
		$this->orgPhone = $newPhone;
	}

	/**accessor method for organization state
	 *
	 * @return String value of organization state
	 */
	public function getOrgState() {
		return($this->orgState);
	}

	/**
	 * mutator method for the organization state
	 *
	 * @param String $newState new organization state
	 * @throws InvalidArgumentException if $newState is empty or insecure
	 * @throws RangeException if $newState is too large for the database
	 */
	public function setOrgState($newState) {
		//check that state is not empty and secure
		$newState = trim($newState);
		$newState = filter_var($newState, FILTER_SANITIZE_STRING);
		if(empty($newState) === true) {
			throw new InvalidArgumentException("state is empty or insecure");
		}

		//check the length of the state code
		if(strlen($newState) > 2) {
			throw new RangeException("state abbreviation is too large");
		}

		//store the new value
		$this->orgState = $newState;
	}

	/**
	 * accessor method for the organization type
	 *
	 * @return String value of organization type
	 */
	public function getOrgType() {
		return $this->getOrgType();
	}

	/**
	 * mutator method for the organization type
	 *
	 * @param String $newType new organization type
	 * @throws InvalidArgumentException if $newType is empty or insecure
	 * @throws RangeException if $newType is too large for the database
	 */
	public function setOrgType($newType) {
		//check that type is not empty and secure
		$newType = trim($newType);
		$newType = filter_var($newType, FILTER_SANITIZE_STRING);
		if(empty($newType) === true) {
			throw new InvalidArgumentException("organization type is empty or insecure");
		}

		//check that type will fit in the database
		if(strlen($newType) > 1) {
			throw new RangeException("organization type is too large");
		}

		//store the value
		$this->orgType = $newType;
	}

	/**accessor method for the organization zip code
	 *
	 * @return String value of the organization zip code
	 **/

	public function getOrgZip() {
		return $this->orgZip;
	}

	/**
	 * mutator method for the organization zip code
	 *
	 * @param String $newZip new zip code of the organization
	 * @throws InvalidArgumentException if $newZip is empty or insecure
	 * @throws RangeException if $newZip is too large for the database
	 */
	public function setOrgZip($newZip) {
	//check that new zip code is secure and not empty
		$newZip = trim($newZip);
		$newZip = filter_var($newZip, FILTER_SANITIZE_STRING);
		if(empty($newZip === true)) {
			throw new InvalidArgumentException("zip code is empty or insecure");
		}
		//check that the new zip code is the proper length
		if(!(strlen($newZip) === 10 ^ strlen($newZip) === 5)) {
			throw new RangeException("zip code is not the proper length");
		}
		//store the new value
		$this->orgZip = $newZip;
	}

	/**
	 * function to insert the new organization into the database
	 *
	 * @param PDO $pdo pdo connection object
	 * @throws PDOException when mySQL related errors occur
	 */
	public function insert (PDO $pdo) {
		//if the orgId is not null, this is not a new entry: don't insert into the database
		if($this->orgId !== null) {
			throw(new PDOException("not a new organization"));
		}

		//create query template
		$query = "INSERT INTO organization(orgAddress1, orgAddress2, orgCity, orgDescription, orgHours, orgName, orgPhone, orgState, orgType, orgZip)
					VALUES(:orgAddress1, :orgAddress2, :orgCity, :orgDescription, :orgHours, :orgName, :orgPhone, :orgState, :orgType, :orgZip)";
		$statement = $pdo->prepare($query);

		//bind member variables to the placeholders in the template
		$parameters = array("orgAddress1" => $this->orgAddress1, "orgAddress2" => $this->orgAddress2,
							"orgCity" => $this->orgCity, "orgDescription" => $this->orgDescription, "orgHours" => $this->orgHours,
							"orgName" => $this->orgName, "orgPhone" => $this->orgPhone, "orgState" => $this->orgState,
							"orgType" => $this->orgType, "orgZip" => $this->orgZip);
		$statement->execute($parameters);

		//update the class with the mySQL-assigned id
		$this->orgId = intval($pdo->lastInsertId());
	}

	/**
	 * function to delete an organization from the database
	 *
	 * @param PDO $pdo pdo connection object
	 * @throws PDOException when mySQL related errors occur
	 */
	public function delete(PDO $pdo) {
		//ensure the organization we are trying to delete exists in the database
		if($this->orgId === null) {
			throw (new PDOException("unable to delete an organization that does not exist"));
		}

		//create query template
		$query = "DELETE FROM organization WHERE orgId = :orgId";
		$statement = $pdo->prepare($query);

		//bind the values to their placeholders in the template, and execute
		$parameters = array("orgId" => $this->orgId);
		$statement->execute($parameters);
	}

	/**
	 * function to update an organization in mySQL
	 *
	 * @param PDO $pdo pdo connection object
	 * @throws PDOException when mySQL related errors occur
	 */
	public function update(PDO $pdo) {
		//ensure the organization we are trying to update exists in the database
		if($this->orgId === null) {
			throw (new PDOException("unable to update an organization that does not exist"));
		}

		//create query template
		$query = "UPDATE organization SET orgAddress1 = :orgAddress1, orgAddress2 = :orgAddress2, orgCity = :orgCity, orgDescription = :orgDescription,
						orgHours= :orgHours, orgName = :orgName, orgPhone = :orgPhone, orgState = :orgState, orgType = :orgType, orgZip = :orgZip
						WHERE orgId = :orgId";
		$statement = $pdo->prepare($query);

		//bind the values to their placeholders in the template, and execute
		$parameters = array("orgAddress1" => $this->orgAddress1, "orgAddress2" => $this->orgAddress2,
				"orgCity" => $this->orgCity, "orgDescription" => $this->orgDescription, "orgHours" => $this->orgHours,
				"orgName" => $this->orgName, "orgPhone" => $this->orgPhone, "orgState" => $this->orgState,
				"orgType" => $this->orgType, "orgZip" => $this->orgZip, "orgId" => $this->orgId);
		$statement->execute($parameters);
	}
	/**
	 * function to retrieve organizations by organization ID
	 *
	 * @param PDO $pdo pdo connection object
	 * @param int $orgId org id to search for
	 * @return mixed organization if found or null if not found
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function getOrganizationByOrgId(PDO $pdo, $orgId){
		//verify that the id to search by is a valid integer
		$orgId = filter_var($orgId, FILTER_VALIDATE_INT);
		if($orgId === false) {
			throw new PDOException("organization id is not an integer");
		}
		if($orgId <= 0) {
			throw new PDOException("organization id is not positive");
		}

		//create query template
		$query = "SELECT orgId, orgAddress1, orgAddress2, orgCity, orgDescription, orgHours, orgName, orgPhone, orgState, orgType, orgZip
						FROM organization WHERE orgId = :orgId";
		$statement = $pdo->prepare($query);

		//bind the id to its placeholder in the template, and execute
		$parameters = array("orgId" => $orgId);
		$statement->execute($parameters);

		//grab the result from mySQL
		try {
			$organization = null;
			//set fetch mode to retrieve the result as an array indexed by column name
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row = $statement->fetch();

			//if the fetch succeeded, store it in a new object
			if($row !== false) {
				$organization = new Organization($row["orgId"], $row["orgAddress1"], $row["orgAddress2"], $row["orgCity"],
						$row["orgDescription"], $row["orgHours"], $row["orgName"], $row["orgPhone"], $row["orgState"],
						$row["orgType"], $row["orgZip"]);
			}
		} catch(Exception $exception) {
			//rethrow the exception if the retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $organization;
	}

	/**
	 * function to store multiple database results into an SplFixedArray
	 *
	 * @param PDOStatement $statement pdo statement object
	 * @return SPLFixedArray all organizations obtained from database
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function storeSQLResultsInArray(PDOStatement $statement) {
		//build an array of tweets, as an SPLFixedArray object
		//set the size of the object to the number of retrieved rows
		$retrievedOrgs = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);

		//while rows can still be retrieved from the result
		while(($row = $statement->fetch()) !== false) {
			try {
				$organization = new Organization($row["orgId"], $row["orgAddress1"], $row["orgAddress2"], $row["orgCity"],
						$row["orgDescription"], $row["orgHours"], $row["orgName"], $row["orgPhone"], $row["orgState"],
						$row["orgType"], $row["orgZip"]);
				//place result in the current field, then advance the key
				$retrievedOrgs[$retrievedOrgs->key()] = $organization;
				$retrievedOrgs->next();
			} catch(Exception $exception) {
				//rethrow the exception if retrieval failed
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $retrievedOrgs;
	}

	/**
	 * function to retrieve organizations by city
	 *
	 * @param PDO $pdo pdo connection object
	 * @param String $orgCity org city to search for
	 * @return SplFixedArray all organizations found for this content
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function getOrganizationByOrgCity(PDO $pdo, $orgCity) {
		//sanitize the input
		$orgCity = trim($orgCity);
		$orgCity = filter_var($orgCity, FILTER_SANITIZE_STRING);
		if(empty($orgCity) === true) {
			throw(new PDOException("city is invalid"));
		}

		//create query template
		$query = "SELECT orgId, orgAddress1, orgAddress2, orgCity, orgDescription, orgHours, orgName, orgPhone, orgState, orgType, orgZip
						FROM organization WHERE orgCity = :orgCity";
		$statement = $pdo->prepare($query);

		//bind the city value to the placeholder in the template
		$orgCity = "%$orgCity%";
		$parameters = array("orgCity" => $orgCity);
		$statement->execute($parameters);

		//call the function to build an array of the retrieved results
		try {
			$retrievedOrgs = Organization::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedOrgs;
	}

	/**
	 * function to retrieve organizations by name
	 *
	 * @param PDO $pdo pdo connection object
	 * @param String $orgName org city to search for
	 * @return SplFixedArray all organizations found for this content
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function getOrganizationByOrgName(PDO $pdo, $orgName) {
		//sanitize the input
		$orgName = trim($orgName);
		$orgName = filter_var($orgName, FILTER_SANITIZE_STRING);
		if(empty($orgName) === true) {
			throw(new PDOException("name is invalid"));
		}

		//create query template
		$query = "SELECT orgId, orgAddress1, orgAddress2, orgCity, orgDescription, orgHours, orgName, orgPhone, orgState, orgType, orgZip
						FROM organization WHERE orgName = :orgName";
		$statement = $pdo->prepare($query);

		//bind the name value to the placeholder in the template
		$orgName = "%$orgName%";
		$parameters = array("orgName" => $orgName);
		$statement->execute($parameters);

		//call the function to build an array of the retrieved results
		try {
			$retrievedOrgs = Organization::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedOrgs;
	}

	/**
	 * function to retrieve organizations by state
	 *
	 * @param PDO $pdo pdo connection object
	 * @param String $orgState org state to search for
	 * @return SplFixedArray all organizations found for this content
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function getOrganizationByOrgState(PDO $pdo, $orgState) {
		//sanitize the input
		$orgState = trim($orgState);
		$orgState = filter_var($orgState, FILTER_SANITIZE_STRING);
		if(empty($orgState) === true) {
			throw(new PDOException("state is invalid"));
		}

		//create query template
		$query = "SELECT orgId, orgAddress1, orgAddress2, orgCity, orgDescription, orgHours, orgName, orgPhone, orgState, orgType, orgZip
						FROM organization WHERE orgState = :orgState";
		$statement = $pdo->prepare($query);

		//bind the state value to the placeholder in the template
		$orgState = "$orgState";
		$parameters = array("orgState" => $orgState);
		$statement->execute($parameters);

		//call the function to build an array of the retrieved results
		try {
			$retrievedOrgs = Organization::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedOrgs;
	}

	/**
	 * function to retrieve organizations by type
	 *
	 * @param PDO $pdo pdo connection object
	 * @param String $orgType org type to search for
	 * @return SplFixedArray all organizations found for this content
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function getOrganizationByOrgType(PDO $pdo, $orgType) {
		//sanitize the input
		$orgType = trim($orgType);
		$orgType = filter_var($orgType, FILTER_SANITIZE_STRING);
		if(empty($orgType) === true) {
			throw(new PDOException("type is invalid"));
		}

		//create query template
		$query = "SELECT orgId, orgAddress1, orgAddress2, orgCity, orgDescription, orgHours, orgName, orgPhone, orgState, orgType, orgZip
						FROM organization WHERE orgType = :orgType";
		$statement = $pdo->prepare($query);

		//bind the type value to the placeholder in the template
		$orgType = "$orgType";
		$parameters = array("orgType" => $orgType);
		$statement->execute($parameters);

		//call the function to build an array of the retrieved results
		try {
			$retrievedOrgs = Organization::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedOrgs;
	}

	/**
	 * function to retrieve organizations by zip code
	 *
	 * @param PDO $pdo pdo connection object
	 * @param String $orgZip org zip code to search for
	 * @return SplFixedArray all organizations found for this content
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function getOrganizationByOrgZip(PDO $pdo, $orgZip) {
		//sanitize the input
		$orgZip = trim($orgZip);
		$orgZip = filter_var($orgZip, FILTER_SANITIZE_STRING);
		if(empty($orgZip) === true) {
			throw(new PDOException("zip code is invalid"));
		}

		//create query template
		$query = "SELECT orgId, orgAddress1, orgAddress2, orgCity, orgDescription, orgHours, orgName, orgPhone, orgState, orgType, orgZip
						FROM organization WHERE orgZip = :orgZip";
		$statement = $pdo->prepare($query);

		//bind the type value to the placeholder in the template
		$orgZip = "%$orgZip%";
		$parameters = array("orgZip" => $orgZip);
		$statement->execute($parameters);

		//call the function to build an array of the retrieved results
		try {
			$retrievedOrgs = Organization::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedOrgs;
	}

	/**
	 * retrieves all organizations
	 *
	 * @param PDO $pdo pdo connection object
	 * @return SplFixedArray all organizations
	 * @throws PDOException if mySQL errors occur
	 */
	public static function getAllOrganizations(PDO $pdo) {

		//create query template
		$query = "SELECT orgId, orgAddress1, orgAddress2, orgCity, orgDescription, orgHours, orgName, orgPhone, orgState, orgType, orgZip
						FROM organization";
		$statement = $pdo->prepare($query);
		$statement->execute();

		///call the function to build an array of the retrieved results
		try {
			$retrievedOrgs = Organization::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedOrgs;
	}
}
