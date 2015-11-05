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
	 * the zipcode of the organization
	 **/
	private $orgZip;

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
}