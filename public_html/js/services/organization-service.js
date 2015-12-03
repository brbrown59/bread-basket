app.constant("ORGANIZATION_ENDPOINT", "php/api/organization/");//check the end point
app.service("OrganizationService", function($http, ORGANIZATION_ENDPOINT) {
	function getUrl() {
		return(ORGANIZATION_ENDPOINT);
	}

	function getUrlForId(orgId) {
		return(getUrl() + orgId)
	}
	//getting all
	this.all = function() {
		return($http.get(getUrl()));
	};

	//get by ID
	this.fetch = function(orgId) {
		return($http.get(getUrlForId(orgId)));
	};
	//need to write the other gets, probably with more "getUrlForX" functions
	//also need to figure out what to use besides .fetch
	//might need to unwrite the thing above to handle multiple use cases
	//org IDs are probably going to be derived from the volunteer table 90% of the time

	this.create = function(organization) { //should be taking in an entire chunk of JSON???
		return($http.post(getUrl(), organization));
	};

	this.update = function(orgId, organization) {
		return($http.put(getUrlForId(orgId), organization));
	};

}