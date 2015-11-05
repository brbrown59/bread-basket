<?php
/**
 * Administrator for Bread Basket.
 * this post is for Administrator classes.
 *
 * @author Carlos Beraun AKA CarlosMacUser cberaun2@cnm.edu
 **/

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
	 * @var
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
	 * Id for the hash on The Administrator password
	 * @var string $adminHash
	 */
	private $adminHash;

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
	 * Id for thr encrypted Administrator password salt data.
	 * @var string $admin
	 */
	private $adminSalt;


?>