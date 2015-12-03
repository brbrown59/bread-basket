app.constant("VOLUNTEER_ENDPOINT", "api/volunteer/");
app.service("VolunteerService", function($http, VOLUNTEER_ENDPOINT) {
	function getUrl() {
		return(VOLUNTEER_ENDPOINT);
	}

	function getUrlForId(volId) {
		return(getUrl() + volId);
	}

	function getUrlForEmail(volEmail) {
		return(getUrl + volEmail);
	}

	function getUrlForIsAdmin(volIsAdmin) {
		return(getUrl + volIsAdmin);
	}

	function getUrlForVolPhone(volPhone) {
		return(getUrl + volPhone)
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetch = function(volId) {
		return($http.get(getUrlForId(volId)));
	};

	this.fetch = function(volEmail) {
		return($http.get(getUrlForEmail(volEmail)));
	};

	this.fetch = function(volIsAdmin) {
		return($http.get(getUrlForIsAdmin(volIsAdmin)));
	};

	this.fetch = function(volPhone) {
		return($http.get(getUrlForVolPhone(volPhone)));
	};

	this.create = function(volunteer) {
		return($http.post(getUrl(), volunteer));
	};

	this.update = function(volId, volunteer) {
		return($http.put(getUrlForId(volId), volunteer));
	};

	this.destroy = function(misquoteId) {
		return($http.delete(getUrlForId(misquoteId)));
	};
});