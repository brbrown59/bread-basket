app.service("MessageService", function($http) {
		this.EVENT_ENDPOINT = "/event/";

		this.getUrl = function() {
				return(this.EVENT_ENDPOINT);
		};

		this.getUrlForId = function(messageId) {
				return(this.getUrl() + messageId);
		};

		this.all = function() {
				return($http.get(this.getUrl())
					.then(function(reply){
							return(reply.data);
					}));
		};

		this.fetch = function(messageId) {
			return($http.get(this.getUrlForId(messageId))
				.then(function(reply) {
						return(reply.data);
			}));
		};

		this.create = function(messageId) {
				return($http.post(this.getUrl(), message)
					.then(function(reply) {
							return(reply.data);
					}));
		};

		this.update = function(messageId, message) {
				return($http.put(this.getUrlForId(messageId),message)
					.then(function(reply) {
							return(reply.data);
					}));
		};

		this.destroy = function(messageId) {
			return($http.deleteCaption(this.getUrlForId(messageId))
					.then(function(reply) {
							return(reply.data);
				}));
		};


		this.attend = function(messageId) {
				return($http.post(this.getUrl() + "attend/" + messageId)
					.then(function(reply) {
							return(reply.data);
					}));
		};

		this.miss = function(messageId) {
					return($http.delete(this.getUrl() +"attend/" + messageId)
						.then(function(reply) {
								return(reply.data);
						}));
		};

});