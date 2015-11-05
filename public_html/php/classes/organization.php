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
	 * ID for the organization: this is the primary key
	 * @var int $orgId;
 	**/
	private $orgId;

	/**
	 * The primary address info of the organization
	 * @var String $orgAddress1;
	 **/
	private $orgAddress1;

	/**
	 * The secondary address info of the organization
	 * @var String $orgAddress2;
	 **/
	private $orgAddress2;

	/**
	 * The city of the organization
	 * @var String $orgCity;
	 **/
	private $orgCity;

	/**
	 * A description of the organization
	 * @var String $orgDescription;
	 **/
	private $orgDescription;

	/**
	 * The listed hours of the organization
	 * @var String $orgHours
	 **/
	private $orgHours;

	/**
	 * The name of the organization
	 * @var String $orgName
	 **/
	private $orgName;

	/**
	 * The organization's phone number
	 * @var String $orgPhone
	 **/
	private $orgPhone;

	/**
	 * The organization's state
	 * @var String $orgState
	 **/
	private $orgState;

	/**
	 * A one character field flagging the type of organization
	 * @var String $orgType
	 **/
	private $orgType;

	/**
	 * The zipcode of the organization
	 **/
	private $orgZip;
}