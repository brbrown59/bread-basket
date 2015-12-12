app.constant("ORGANIZATION_ENDPOINT", "../../php/api/organization/");
app.service("OrgTypeService", function($http, ORGANIZATION_ENDPOINT) {
	//internal function for holding the url
	function getUrl() {
		return(ORGANIZATION_ENDPOINT);
	}

	//get the current organization
	this.fetchCurrent = function() {
		return($http.get(getUrl() + "?current=true"));
	};

});