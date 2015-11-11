<?php
/**
 * Administrator for Bread Basket.
 * this post is for Administrator classes.
 *
 * @author Carlos Beraun AKA CarlosMacUser cberaun2@cnm.edu
 **/

require_once("autoloader.php");

class Administrator {
	/**
	 * Id for this Administrator: this is the primary key
	 * @var int $adminId
	 */
	private $adminId;

	/**
	 *Id for this Volunteer is for the Volunteer that makes a claim on a listing; this is the foreign key
	 * @var int $volId
	 */
	private $volId;

	/**
	 * Id for this Organization is for the organization that claims listing; this is the foreign key
	 * @var int $ordId;
	 */
	private $orgId;

	/**
	 * Id for the The Administrator Email address.
	 * @var string $adminEmail
	 */
	private $adminEmail;

	/**
	 * Id for the activation of Administrators Email address.
	 * @var int $adminEmailActivation
	 */
	private $adminEmailActivation;

	/**
	 * Id for the The Administrator users First Name
	 * @var string $adminFirstName
	 */
	private $adminFirstName;


	/**
	 * Id for the The Administrator users Last Name
	 * @var string $adminLastName
	 */
	private $adminLastName;

	/**
	 * Id for the The Administrator contact phone number
	 * @var string $adminPhone
	 */
	private $adminPhone;



	/**
	 * Constructors for this Administrator ID
	 *
	 * @param $newAdminId
	 * @param $newVolId
	 * @param $newOrgId
	 * @param $newAdminEmail
	 * @param $newAdminEmailActivation
	 * @param $newAdminFirstName
	 * @param $newAdminLastName
	 * @param $newAdminPhone
	 * @throws Exception
	 *
	 */

	public function __construct($newAdminId, $newVolId, $newOrgId, $newAdminEmail, $newAdminEmailActivation, $newAdminFirstName, $newAdminLastName, $newAdminPhone) {
		try {
			$this->setAdminId($newAdminId);
			$this->setVolId($newVolId);
			$this->SetOrgId($newOrgId);
			$this->setAdminEmailId($newAdminEmail);
			$this->setAdminEmailActivation($newAdminEmailActivation);
			$this->setAdminFirstName($newAdminFirstName);
			$this->setAdminPhone($newAdminPhone);


		} catch(invalidArgumentException $invalidArgument) {
			// rethrow the exception to the user
			throw(new InvalidArgumentException($invalidArgument->getMessage(), 0, $invalidArgument));


		} catch(RangeException $range) {
			// rethrow the exception to the user
			throw(new RangeException($range->getMessage(), 0, $range));


		} catch(Exception $exception) {
			// rethrow generic exception
			throw(new Exception($exception->getMessage(), 0, $exception));
		}

	}






	/**
	 * Accessor method for the Administrator Id
	 */
	Public function getAdminId() {
		return ($this->adminId);
	}

	/**Mutator for Administrator ID
	 * @param Integer ; $newAdminId new value of Administrator Id
	 * @throw InvalidAgrumentException if the new Administrator Id is not an Integer.
	 **/
	Public function setAdminId($newAdminId) {
		//base case
		if($newAdminId === null) {
			$this->adminId = null;
			return;
		}

		//Verify the Administrator Id is valid
		$newAdminId = filter_var($newAdminId, FILTER_VALIDATE_INT);
		if($newAdminId === false) {
			throw(new InvalidArgumentException("This Administrator IS is not a valid integer"));
		}

		//verify the Administrator ID is positive
		if($newAdminId <= 0) {
			throw (new RangeException("This Administrator IDis not positive"));
		}

		//convert and store the Administrator Id
		$this->adminId = intval($newAdminId);
	}


	/**
	 * Accessor method for the Volunteer Id
	 * @return integer value of Volunteer Id
	 */
	Public function getVolId() {
		return ($this->volId);
	}

	/**Mutator for Vol ID
	 * @param Integer ; $newVolId new value of Volunteer Id
	 * @throw InvalidArgumentException if the new Volunteer Id is not an Integer.
	 **/
	Public function setVolId($newVolId) {
		//base case
		if($newVolId === null) {
			$this->volId = null;
			return;
		}

		//Verify the Volunteer Id is valid
		$newVolId = filter_var($newVolId, FILTER_VALIDATE_INT);
		if($newVolId === false) {
			throw(new InvalidArgumentException("This Volunteer IS is not a valid iteger"));
		}

		//verify the Volunteer ID is positive
		if($newVolId <= 0) {
			throw (new RangeException("This Volunteer ID is not positive"));
		}

		//convert and store the Volunteer Id
		$this->volId = intval($newVolId);
	}






	/**
	 * accessor method for Organization ID
	 * @return int value of Organization ID
	 */
	public function getOrgID() {
		return ($this->orgId);
	}

	/**Mutator for Organization ID
	 * @param Integer ; $newOrgId new value of Organization Id
	 * @throw InvalidArgumentException if the new Organization Id is not an Integer.
	 **/
	Public function setOrgId($newOrgId) {
		//base case
		if($newOrgId === null) {
			$this->adminId = null;
			return;
		}

		//Verify the Organization Id is valid
		$newOrgId = filter_var($newOrgId, FILTER_VALIDATE_INT);
		if($newOrgId === false) {
			throw(new InvalidArgumentException("This Organization ID is not a valid Number"));
		}

		//verify the Organization ID is good
		if($newOrgId <= 0) {
			throw (new RangeException("This Organization ID is not valid"));
		}

		//convert and store the Organization Id
		$this->adminId = intval($newOrgId);
	}






	/**
	 * Accessor for Administrator Email; adminEmailId
	 * @return string value for adminEmail Id
	 */
	public function getAdminEmailId() {
		return($this->adminEmail);
	}

	/**
	 * Mutator method for Administrator Email; adminEmail
	 *
	 * @param String $newAdminEmail new Administrator Email
	 * @throw InvalidArgumentException if $newAdminEmailId is not a string
	 * @throw rangeException if $newAdminEmail is more than 128 characters
	 */
	public function setAdminEmailId($newAdminEmail){

		//Verify the Email for Administrator is valid; adminEmailId
		$newAdminEmail = trim($newAdminEmail);
		$newAdminEmail = filter_var($newAdminEmail, FILTER_SANITIZE_EMAIL);
		if (empty($newAdminEmail) ===true) {
			throw(new InvalidArgumentException ("There is no content in this email"));
		}

		//Verify that the Administrator's Email message is no more than 128 characters
		if(strlen($newAdminEmail) > 128){
			throw(new RangeException("Maximum amount of characters has been exceeded"));
		}

		//Convert and store this Administrator Email; adminEmailId
		$this->adminEmail = $newAdminEmail;
	}






	/**
	 * Accessor for Administrator Email Activation; adminEmailActivation
	 * @return string Value for Administrator Email Activation.
	 */
	public function getAdminEmailActivation(){
		return($this->adminEmailActivation);
	}

	/**
	 * Mutator for Administrator Email Activation; adminEmailActivation
	 * @param String $newAdminEmailActivation new admin email activation
	 * @throw InvalidArgumentException
	 */
	public function setAdminEmailActivation($newAdminEmailActivation){

		//Verify Administrator Email is Valid;adminEmailActivation
		$newAdminEmailActivation = filter_var($newAdminEmailActivation, FILTER_SANITIZE_STRING);
		if(strlen($newAdminEmailActivation) < 16) {
			throw(new InvalidArgumentException("activation code is insufficient or insecure"));
		}

		//Verify Administrator Email "will fit in the DATABASE" pkk;adminEmailActivation
		if(strlen($newAdminEmailActivation) > 16) {
			throw(new RangeException("Activation Code is too large"));
		}

		//Store Activation for Administrator Email;adminEmailActivation
		$this->adminEmailActivation = $newAdminEmailActivation;
	}




	/**
	 * Accessor for Administrator First Name; adminFirstName; adminFirstName
	 * @return string value for the Administrators First Name.
	 */
	public function getAdminFirstName(){
		return($this->adminFirstName);
	}

	/**
	 * Mutator for the Administrators First Name; adminFirstName
	 * @param String $newAdminFirstName
	 * @throw Invalid ArgumentException if Administrators First Name is not a string
	 * @throw RangeException if Administrator First Name is to long.
	 */
	public function setAdminFirstName($newAdminFirstName) {
		//Verify that First name is valid
		$newAdminFirstName = trim($newAdminFirstName);
		$newAdminFirstName = filter_var($newAdminFirstName, FILTER_SANITIZE_STRING);
		if(empty ($newAdminFirstName) === true)  {
			throw(new InvalidArgumentException("First Name is Empty or Insecure"));
		}

		//Verify the first name will fit in the database.
		if(strlen($newAdminFirstName) > 32){
			throw(new RangeException("First Name is too long"));
		}

		//Store the first name.
		$this->adminFirstName = $newAdminFirstName;
	}





	/**
	 * Accessor for Administrator Last Name; adminLastName
	 * @return string value for the Administrators Last Name.
	 */
	public function getAdminLastName(){
		return($this->adminLastName);
	}

	/**
	 * Mutator for the Administrators Last Name; adminLastName
	 * @param String $newAdminLastName
	 * @throw Invalid ArgumentException if Administrators Last Name is not a string
	 * @throw RangeException if Administrator Last Name is to long.
	 */
	public function setAdminLastName($newAdminLastName) {
		//Verify that Last name is valid
		$newAdminLastName = trim($newAdminLastName);
		$newAdminLastName = filter_var($newAdminLastName, FILTER_SANITIZE_STRING);
		if(empty ($newAdminLastName) === true)  {
			throw(new InvalidArgumentException("First Name is Empty or Insecure"));
		}

		//Verify the Last name will fit in the database.
		if(strlen($newAdminLastName) > 32){
			throw(new RangeException("Last Name is too long"));
		}

		//Store the first name.
		$this->adminLastName = $newAdminLastName;
	}




	/**
	 *Accessor for the Administrators phone number.
	 * @return string value of Phone Number.
	 */
	public function getAdminPhone(){
		return($this->adminPhone);
	}

	/**
	 * Mutator for Administrator Phone Number
	 *
	 * @param string $newAdminPhone
	 * @throw InvalidArgumentException if Administrators Phone Number is not a string.
	 * @throw RangeException if $newAdminPhone is contains more than 32 characters.
	 */
	public function setAdminPhone($newAdminPhone) {
		//Verify that the Phone Number is Secure
		$newAdminPhone = trim($newAdminPhone);
		$newAdminPhone = filter_var($newAdminPhone, FILTER_SANITIZE_STRING);
		if(empty ($newAdminPhone) === true) {
			throw(new InvalidArgumentException("Please Enter Phone Number"));
		}

		//Verify the PHone Number will fit in the database
		if(strlen($newAdminPhone) > 32) {
			throw(new RangeException("Phone Number is to long"));
		}

		//Store Administrator Phone Number.
		$this->adminPhone = $newAdminPhone;

	}




	/**
	 * Insert Administrator into mySQL; adminId
	 *
	 * @param PDO $pdo PDO connection object
	 * @throw PDO exception when mySQL related errors occur
	 */
	public function insert(PDO $pdo) {
		//verify that adminId id null, and does not allow duplicate adminId
		if($this->adminId !== null){
			throw (new PDOException("This Administrator already exists"));
		}

		//Create Query Template.
		$query = "INSERT INTO administrator(volId, orgId, adminEmail, adminEmailActivation, adminFirstName, adminLastName, adminPhone) VALUES(:volId, :orgId, :adminEmail, :adminEmailActivation, :adminFirstName, :adminLastName, :adminPhone)";
		$statement = $pdo->prepare($query);

		//Blind the member variables to the place holder in the template.
		$parameters = array("volId" => $this->volId, "orgId" => $this->orgId, "adminEmail" => $this->adminEmail, "adminEmailActivation" => $this->adminEmailActivation, "adminFirstName" => $this->adminFirstName, "adminLastName" => $this->adminLastName, "adminPhone" => $this->adminPhone);
		$statement->execute($parameters);

		//Update the null adminId whith what mySQl just gave us.
		$this->adminId = intval($pdo->lastInsertId() );
	}




	/**
	 * Delete this Administrator from mySQL
	 *
	 * @param PDO $pdo PDO Connection object.
	 * @throws PDO exception when mySQL related errors occur
	 */
	public function delete(PDO $pdo) {
		//enforce that the adminId is not null
		if($this->adminId === null) {
			throw(new PDOException("Unable to delete a Administrator that does not exist"));
		}

		//create query template
		$query = "DELETE FROM administrator WHERE adminID =:adminID";
		$statement = $pdo->prepare($query);

		//Bind the variables to the place holder in the template
		$parameters = array("adminId" => $this->adminId);
		$statement ->execute($parameters);
	}




	/**
	 * Update this Administrator in mySQL
	 *
	 * @param PDO $pdo PDO connection object
	 * @throw PDOException when mySQL related errors occur
	 */
	Public function update(PDO $pdo){
		//Enforce the Administrator is null(i.e, do not update a administrator that hasn't been inserted)
		if($this->adminId === null) {
			throw(new PDOException("Unable to update Administrator that does not exist"));
		}

		//Create Query Template
		$query ="UPDATE administrator SET volId = :volId, orgId = :ordId, adminEmail = :adminEmail,  adminEmailActivation= :adminEmailActivation, adminFirstName  = :adminFirstName,  adminLastName = :adminLastName,  adminPhone= :adminPhone,  adminPhone= :adminPhone";
		$statement = $pdo->prepare($query);

		//Bind the Variables tot he place holder in the template.
		$parameters = array("volId"=> $this->volId, "orgId"=> $this->orgId, "adminEmail"=> $this->adminEmail, "adminEmailActivation"=> $this->adminEmailActivation, "adminFirstName"=> $this->adminFirstName, "dminLastName"=> $this->adminLastName, "adminPhone"=> $this->adminPhone);
		$statement->execute($parameters);
	}



	/**
	 * Get Administrator by adminId
	 *
	 * @param PDO $pdo PDO connection object
	 * @param int $adminId Administrator Id to search for
	 * @return mixed Administrator found or null if not found
	 * @throw PDOException when mySQL related errors occur
	 */

	public static function getAdministratorByAdminId(PDO $pdo, $adminId) {
		//sanitize the adminId before searching
		$adminId = Filter_var($adminId, FILTER_VALIDATE_INT);
		if($adminId === false) {
			throw(new PDOException("Administrator ID is not a integer"));
		}
		if($adminId <= 0) {
			throw(new PDOException("Administrator ID is not Positive"));
		}
		//create query template
		$query = "SELECT adminId, volId, orgId, adminEmail, adminEmailActivation, adminFirstName, adminLastName, adminPhone, adminPhone FROM administrator WHERE adminId = :adminId";
		$statement = $pdo->prepare($query);

		//Bind the administraotr id to the place holder in the template
		$parameters = array("adminId" => $adminId);
		$statement->execute($parameters);

		//grab the administrator from mySQL
		try {
			$administrator = null;
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$administrator = new administrator($row["adminId"], $row["volId"], $row["ordId"], $row["adminEmail"], $row["AdminEmailActivation"], $row["adminFirstName"], $row["adminLastName"], $row["adminPhone"]);
			}
		}catch(Exception $exception){
			//if the row could not be converted, rethrow it
			throw(new PDOException($exception->getmessage(),0, $exception));
		}
		return($administrator);

	}


	/**
	 * function to store multiple database results into an SplFixedArray
	 *
	 * @param PDOStatement $statement pdo statement object
	 * @return SPLFixedArray all administrators obtained from database
	 * @throws PDOException if mySQL related errors occur
	 */
	public static function storeSQLResultsInArray(PDOStatement $statement) {
		//build an array of organizations, as an SPLFixedArray object
		//set the size of the object to the number of retrieved rows
		$retrievedAdmin = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);

		//while rows can still be retrieved from the result
		while(($row = $statement->fetch()) !== false) {
			try {
				$administrator = new administrator($row["adminId"], $row["volId"], $row["ordId"], $row["adminEmail"], $row["AdminEmailActivation"], $row["adminFirstName"], $row["adminLastName"], $row["adminPhone"]);
				//place result in the current field, then advance the key
				$retrievedAdmin[$retrievedAdmin->key()] = $administrator;
				$retrievedAdmin->next();
			} catch(Exception $exception) {
				//rethrow the exception if retrieval failed
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}
		return $retrievedAdmin;
	}

	/**
	 * get administrator by organization id
	 *
	 * @param PDO $pdo pdo connection object
	 * @param int $orgId organization this administrators is associated with
	 * @return SplFixedArray all administrators found for this content
	 * @throws PDOException if mySQL related errors occur
	 **/
	public static function getAdministratorByOrgId(PDO $pdo, $orgId) {
		//sanitize the input
		$orgId = filter_var($orgId, FILTER_VALIDATE_INT);
		if(empty($orgId) === true) {
			throw(new PDOException("org id is not an integer"));
		}
		if($orgId <= 0) {
			throw(new PDOException("org id is not positive"));
		}

		//create query template
		$query = "SELECT adminId, volId, orgId, adminEmail, adminEmailActivation, adminFirstName, adminLastName, adminPhone, adminPhone FROM administrator WHERE orgId = :orgId";
		$statement = $pdo->prepare($query);

		//bind the id value to the placeholder in the template
		$parameters = array("orgId" => $orgId);
		$statement->execute($parameters);

		//call the function to build and array of the retrieved values
		try {
			$retrievedAdmin = Administrator::storeSQLResultsInArray($statement);
		} catch(Exception $exception) {
			//rethrow the exception if the retrieval failed
			throw(new PDOException($exception->getMessage(), 0, $exception));
		}
		return $retrievedAdmin;
	}



	/**
	 * Get Administrator by volId
	 *
	 * @param PDO $pdo PDO connection object
	 * @param int $volId Administrator Id to search for
	 * @return mixed Administrator found or null if not found
	 * @throw PDOException when mySQL related errors occur
	 */

	public static function getAdministratorByVolId(PDO $pdo, $volId) {
		//sanitize the adminId before searching
		$volId = Filter_var($volId, FILTER_VALIDATE_INT);
		if(empty($volId) === true) {
			throw(new PDOException("Volunteer ID is not a integer"));
		}
		if($volId <= 0) {
			throw(new PDOException("Administrator ID is not Positive"));
		}
		//create query template
		$query = "SELECT adminId, volId, orgId, adminEmail, adminEmailActivation, adminFirstName, adminLastName, adminPhone, adminPhone FROM administrator WHERE volId = :volId";
		$statement = $pdo->prepare($query);

		//Bind the administrator id to the place holder in the template
		$parameters = array("volId" => $volId);
		$statement->execute($parameters);

		//grab the administrator from mySQL
		try {
			$administrator = null;
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$administrator = new administrator($row["adminId"], $row["volId"], $row["ordId"], $row["adminEmail"], $row["AdminEmailActivation"], $row["adminFirstName"], $row["adminLastName"], $row["adminPhone"]);
			}
		}catch(Exception $exception){
			//if the row could not be converted, rethrow it
			throw(new PDOException($exception->getmessage(),0, $exception));
		}
		return($administrator);

	}


	/**
	 * Get Administrator by adminEmail
	 *
	 * @param PDO $pdo PDO connection object
	 * @param int $adminEmail Administrator email to search for
	 * @return mixed adminEmail found or null if not found
	 * @throw PDOException when mySQL related errors occur
	 */

	public static function getAdministratorByAdminEmail(PDO $pdo, $adminEmail) {
		//sanitize the adminId before searching
		$adminEmail = Filter_var($adminEmail, FILTER_SANITIZE_EMAIL);
		if (empty($adminEmail) === true) {
			throw(new PDOException("Email is Not VAlid"));
		}

		//create query template
		$query = "SELECT adminId, volId, orgId, adminEmail, adminEmailActivation, adminFirstName, adminLastName, adminPhone, adminPhone FROM administrator WHERE adminEmail = :adminEmail";
		$statement = $pdo->prepare($query);

		//Bind the administraotr email to the place holder in the template
		$parameters = array("adminEmail" => $adminEmail);
		$statement->execute($parameters);

		//grab the administrator email from mySQL
		try {
			$administrator = null;
			$statement->setFetchMode(PDO::FETCH_ASSOC);
			$row = $statement->fetch();
			if($row !== false) {
				$administrator = new administrator($row["adminId"], $row["volId"], $row["ordId"], $row["adminEmail"], $row["AdminEmailActivation"], $row["adminFirstName"], $row["adminLastName"], $row["adminPhone"]);
			}
		}catch(Exception $exception){
			//if the row could not be converted, rethrow it
			throw(new PDOException($exception->getmessage(),0, $exception));
		}
		return($administrator);

	}



	/**
	 * Get all Administrators
	 *
	 * @param PDO $pdo connection object
	 * @return SplFixedArray all Administrators found
	 * @throws PDOException when mySQL reaalted errors occur
	 */
	public static function getAllAdministrators(PDO $pdo){
		//create query template
		$query = "SELECT adminId, volId, orgId, adminEmail, adminEmailActivation, adminFirstName, adminLastName, adminPhone, adminPhone FROM administrator";
		$statement = $pdo->prepare($query);
		$statement->execute();

		//Build an array of Administrators
		$administrators = new SplFixedArray($statement->rowCount());
		$statement->setFetchMode(PDO::FETCH_ASSOC);
		while(($row = $statement->fetch()) !== false){
			try{
				$administrator = new administrator($row["adminId"], $row["volId"], $row["ordId"], $row["adminEmail"], $row["AdminEmailActivation"], $row["adminFirstName"], $row["adminLastName"], $row["adminPhone"]);
				$administrators[$administrators->key()] = $administrator;
				$administrators->next();
			} catch(Exception $exception){
				//if the row could not be converted, rethrow it.
				throw(new PDOException($exception->getMessage(), 0, $exception));
			}
		}

		return($administrators);
	}


}


?>