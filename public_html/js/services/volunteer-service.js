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

	this.fetchId = function(volId) {
		return($http.get(getUrlForId(volId)));
	};

	this.fetchEmail = function(volEmail) {
		return($http.get(getUrlForEmail(volEmail)));
	};

	this.fetchAdmin = function(volIsAdmin) {
		return($http.get(getUrlForIsAdmin(volIsAdmin)));
	};

	this.fetchPhone = function(volPhone) {
		return($http.get(getUrlForVolPhone(volPhone)));
	};

	this.create = function(volunteer) {
		return($http.post(getUrl(), volunteer));
	};

	this.update = function(volId, volunteer) {
		return($http.put(getUrlForId(volId), volunteer));
	};

	this.destroy = function(volId) {
		return($http.delete(getUrlForId(volId)));
	};
});

