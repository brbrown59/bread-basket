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
	 * activation key for Volunteer email
	 * @var int $volEmailActivation
	 */
	private $volEmailActivation;
	/**
	 * first name of Volunteer
	 * @var string $volFirstName
	 */
	private $volFirstName;
	/**
	 * last name of Volunteer
	 * @var string $volLastName
	 */
	private $volLastName;
	/**
	 * phone number for Volunteer
	 * @var string $volPhone
	 */
	private $volPhone;
}