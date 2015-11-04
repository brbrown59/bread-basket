<?php
/**
 * Listing entity
 *
 * The Listing entity is that holds the information about donations available for pick up by the food bank volunteers.
 *
 * @author Tamra Fentermaker <fenstermaker505@gmail.com>
 **/
class listing {
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
	 *@var string $listingMemo
	 */
	private $listingMemo;
	/**
	 * Pulled from the listing Id of the first time a message is sent
	 * @var int $listingParentId
	 */
	private $listingParentId;
	/**
	 * This is the time that the listing was created, in a PHP DateTime object
	 * @var DateTime $listingPostTime
	 */
	private $listingPostTime;
	/**
	 *This is a listing type for the donation. It'll be a dropdown with things like perishable, non perishable, refrigerated
	 * @var string $listingType
	 **/
	private $listingType;
}