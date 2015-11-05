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
	 */
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
	 */
	public function getVolEmailActivation() {
		return($this->volEmailActivation);
	}

	/**
	 * mutator for vol email activation code
	 *
	 * @param string $newVolEmailActivation
	 * @throws InvalidArgumentException if activation code is not a string or insecure
	 */
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
	 */
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
		//verify the last name is a secure
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








}