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
/**
 * accessor method for listing id
 *
 * @return mixed value for listing id
 **/
public function getListingId() {
	return($this->listingId);
}
/**
 * mutator method for listing id
 *
 * @param mixed $newListingId new value of listing id
 * @throws InvalidArgumentException if $newListingId is not an integer
 * @throws RangeException is $newListingId is not positive
 **/
public function setListingId($newListingId) {
	//base case: if the listing id is null, this a new listing without a mySQL assigned id (yet)
	if($newListingId === null) {
		$this->listingId = null;
		return;
	}
	//verify the listing id is valid
	$newListingId = filter_var($newListingId, FILTER_VALIDATE_INT);
	if($newListingId === false) {
		throw(new InvalidArgumentException("listing id is not positive"));
	}

	//convert and store the listing id
	$this->listingId = intval($newListingId);
}
/**
 * accessor method for the organization id
 *
 * @return int value of organization id
 */
public function getOrgId() {
	return($this->orgId);
}
/**
 * mutator method for organization id
 *
 * @param int $newOrgId new value of organization id
 * @throws InvalidArgumentException if $newOrgId is not an integer or not positive
 * @throws RangeException if $newOrgId is not positive
 **/
public function setOrgId($newOrgId) {
	//verify the organization id is valid
	$newOrgId = filter_var($newOrgId, FILTER_VALIDATE_INT);
	if($newOrgId === false){
		throw(new InvalidArgumentException("organization id is not a valid integer"));
}

	//verify the organization id is positive
	if($newOrgId <= 0) {
		throw(new RangeException("organization if is not positive"));
	}

	//convert and store the organization id
	$this->orgId = intval($newOrgId);
}
/**
 * accessor method for listing claimed by. This is the volId of the volunteer that claims the donation
 *
 * @return mixed value of listing claimed by
 */
public function getListingClaimedBy() {
	return($this->listingClaimedBy);
}

/**
 * mutator method for listing claimed by.
 *
 * @param int $newListingClaimedBy new value of listing claimed by
 * @throws InvalidArgumentException if $newClistingClaimedBy is not an integer or not positive
 * @throws RangeException if $newClaimedBy is not positive
 */
public function setListingClaimedBy($newListingClaimedBy) {
	//verify the listing claimed by number is valid
	$newListingClaimedBy = filter_var($newListingClaimedBy, FILTER_VALIDATE_INT);
	if($newListingClaimedBy === false) {
		throw(new InvalidArgumentException("listing claimed by is not a valid integer"));
	}

	//verify the listing claimed by is positive
	if($newListingClaimedBy <= 0) {
		throw(new RangeException("listing claimed by is not positive"));
	}

	//convert and store the listing claimed by
	$this->listingClaimedBy = intval($newListingClaimedBy);
}
/**