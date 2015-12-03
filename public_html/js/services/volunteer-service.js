app.constant("VOLUNTEER_API", "api/volunteer/");
app.service("VolunteerService", function($http, VOLUNTEER_API) {
	function getUrl() {
		return(VOLUNTEER_API);
	}

	function getUrlForId(volId) {
		return(getUrl() + volId);
	}

	this.all = function() {
		return($http.get(getUrl()));
	};

	this.fetchId = function(volId) {
		return($http.get(getUrlForId(volId)));
	};

	this.fetchEmail = function(volEmail) {
		return($http.get(getUrl() + '?email=' + volEmail));
	};

	this.fetchAdmin = function(volIsAdmin) {
		return($http.get(getUrl() + '?isAdmin=' + volIsAdmin));
	};

	this.fetchPhone = function(volPhone) {
		return($http.get(getUrl() + '?phone=' + volPhone));
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

