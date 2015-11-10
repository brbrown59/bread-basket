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
	 * ListingType constructor.
	 * @param $newListingTypeId
	 * @param $newListingTypeInfo
	 * @throws InvalidArgumentException if data types are invalid or insecure
	 * @throws RangeException if data values are out of bounds
	 * @throws Exception if some other exception is thrown
	 */

	public function __construct($newListingTypeId, $newListingTypeInfo) {
		try {
			$this->setListingTypeId($newListingTypeId);
			$this->setListingTypeInfo($newListingTypeInfo);
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

		//convert to int and store
		$this->listingTypeId = intval($newListingTypeId);
	}

	/**
	 * accessor method for the listing type information
	 *
	 * @return String value of listing type information
	 */
	public function getListingTypeInfo() {
		return($this->listingTypeId);
	}

	/**
	 * mutator method for the listing type id
	 *
	 * @param mixed $newListingTypeInfo new value of the listing type info
	 * @throws InvalidArgumentException if $newListingTypeInfo is not an integer
	 * @throws RangeException if $newListingTypeInfo is not positive
	 */
	public function setListingTypeInfo($newListingTypeInfo) {

		//verify the id is valid and secure
		$newListingTypeInfo = trim($newListingTypeInfo);
		$newListingTypeInfo = filter_var($newListingTypeInfo, FILTER_SANITIZE_STRING);
		if(empty($newListingTypeInfo) === true) {
			throw(new InvalidArgumentException("listing type is not valid or insecure"));
		}

		//verify the id is positive
		if(strlen($newListingTypeInfo) > 32) {
			throw(new RangeException("listing type is too large"));
		}

		//convert to int and store
		$this->listingTypeInfo = $newListingTypeInfo;
	}
}