app.constant("MESSAGE_ENDPOINT", "api/message/");
app.service("MessageService", function($http,MESSAGE_ENDPOINT) {
			function getUrl() {
					return(MESSAGE_ENDPOINT);
			}

	//internal function for tracking the Id on to the URL
	function getUrlForId(messageId) {
		return(getUrl() + messageId);
	}

	//get all function.
	this.all = function() {
			return($http.get(getUrl() ));
	};

	//get by Id
	this.fetch = function(messageId){
		return($http.get(getUrlForId(messageId)));
	};

	//get by listingId
	this.fetchListing = function(listingId){
		return($http.get(getUrl() + "?listing=" + listingId));
	};

	//get by orgId
	this.fetchListing = function(orgId){
		return($http.get(getUrl() + "?org=" + orgId));
	};

	//get by messageText
	this.fetchListing = function(messageText){
		return($http.get(getUrl() + "?message=" + messageText));
	};

	//post
	this.create = function(message) {
		return($http.post(getUrl(), message));
	};

	//put
	this.update = function(messageId, message) {
		return($http.post(getUrlForId(messageId), message));
	};

	//delete
	this.destroy = function(messageId){
		return($http.delete(getUrlForId(messageId)));
	};
});
