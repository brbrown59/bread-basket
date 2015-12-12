app.constant("ORGANIZATION_ENDPOINT", "../../php/api/organization/");
app.service("OrganizationService", function($http, ORGANIZATION_ENDPOINT) {
	//internal function for holding the url
	function getUrl() {
		return(ORGANIZATION_ENDPOINT);
	}

	//internal function for tacking the id on to the url
	function getUrlForId(orgId) {
		return(getUrl() + orgId);
	}

	//getting all
	this.all = function() {
		return($http.get(getUrl()));
	};

	//get by ID
	this.fetchId = function(orgId) {
		return($http.get(getUrlForId(orgId)));
	};

	//get by city
	this.fetchCity = function(orgCity) {
		return($http.get(getUrl() + "?city=" + orgCity));
	};
	//get by name
	this.fetchName = function(orgName) {
		return($http.get(getUrl() + "?name=" + orgName));
	};
	//get by state
	this.fetchState = function(orgState) {
		return($http.get(getUrl() + "?state=" + orgState));
	};
	//get by type
	this.fetchType = function(orgType) {
		return($http.get(getUrl() + "?type=" + orgType));
	};
	//get by zip
	this.fetchZip = function(orgZip) {
		return($http.get(getUrl() + "?zip=" + orgZip));
	};

	//post
	this.create = function(organization) {
		return($http.post(getUrl(), organization));
	};

	//put
	this.update = function(orgId, organization) {
		return($http.put(getUrlForId(orgId), organization));
	};

	//delete
	this.destroy = function(orgId) {
		return($http.delete(getUrlForId(orgId)));
	};
});