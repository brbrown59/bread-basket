app.constant("ORGANIZATION_ENDPOINT", "../../php/api/organization/");
app.constant("VOLUNTEER_ENDPOINT", "../../php/api/organization/");
app.service("GetCurrentService", function($http, ORGANIZATION_ENDPOINT, VOLUNTEER_ENDPOINT) {
	//internal function for holding the url
	function getOrgUrl() {
		return(ORGANIZATION_ENDPOINT);
	}

	function getVolUrl() {
		return(VOLUNTEER_ENDPOINT);
	}


	//get the current organization
	this.fetchOrgCurrent = function() {
		return($http.get(getOrgUrl() + "?current=true"));
	};

	this.fetchVolCurrent = function() {
		return($http.get(getVolUrl() + "?current=true"));
	};

});