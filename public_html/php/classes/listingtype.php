<?php

/**
 * an enumerator for listing types
 *
 * This class enumerates all of the different listing types needed by the listing class
 * it contains only a listing type and a listing type ID
 *
 * @author Bradley Brown <tall.white.ninja@gmail.com>
 */

class ListingType {

	/**
	 * id for the listing type: this is the primary key
	 * @var int $listingTypeId
	 */
	private $listingTypeId;

	/**
	 * the information about the listing type
	 * @var String $listingTypeInfo;
	 */
	private $listingTypeInfo;

	/**
	 * accessor method for the listing type id
	 *
	 * @return mixed value of listing type id
	 */
	public function getListingTypeId() {
		return($this->listingTypeId);
	}

	/**
	 * mutator method for the listing type id
	 *
	 * @param mixed $newListingTypeId new value of the listing type id
	 * @throws InvalidArgumentException if $newListingTypeId is not an integer
	 * @throws RangeException if $newListingTypeId is not positive
	 */
	public function setListingTypeId($newListingTypeId) {
		//if the listing type id is null, this is a new listing type not in mySQL; temporarily set it to null
		if($newListingTypeId === null) {
			$this->listingTypeId = null;
			return;
		}

		//verify the id is a valid integer
		$newListingTypeId = filter_var($newListingTypeId, FILTER_VALIDATE_INT);
		if($newListingTypeId === false) {
			throw(new InvalidArgumentException("listing type id is not a valid integer"));
		}

		//verify the id is positive
		if($newListingTypeId <= 0) {
			throw(new RangeException("listing type id is not positive"));
		}

		//convert to int and sore
		$this->listingTypeId = intval($newListingTypeId);
	}
}