app.constant("LISTING_ENDPOINT", "php/api/listing/");
app.service("ListingService", function($http,LISTING_ENDPOINT) {
	//INTERNAL FUNCTION FOR HOLDING THE URL
	function getUrl() {
		return(ORGANIZATION_ENDPOINT);
	}

	//internal function for tracking the id for the URL
	function getUrlForId(listingId) {
			return(getUrl() + listingId);
	}

	//getting all
	this.all = function() {
		return($hrrp.get(getUrl()));
	};

	//get by id
	this.fetch = function(listingId) {
		return($http.get(getUrlForId(listingid)));
	};

	//get by organization; orgId
	this.fetchOrganization = function(orgId) {
		return($http.get(getUrl() + "?organization=" + orgId));
	};

	//get by Listing post Time; listingPostTime
	this.fetch = function(listingPostTime) {
		return($http.get(getUrl() + "?listingPostTime=" + listingPostTime));
	};

	//get by Listing Parent Id; listing
	this.fetch = function(listingParentId) {
		return($http.get(getUrl() + "?listingParentId=" + listingParentId));
	};

	//get by Listing Type Id;
	this.fetch = function(listingTypeId) {
		return($http.get(getUrl() + "?listingTypeId=" + listingTypeId));
	};

	//post
	this.create = function(listing) {
		return($http.post(getUrl(), listing));
	};

	//put
	this.update = function(listingId, listing){
		return($http.put(getUrlForId(listingId), listing));
	};

	//delete
	this.destroy = function(listingId) {
		return($http.delete(getUrlForId(listingId)));
	};
});
