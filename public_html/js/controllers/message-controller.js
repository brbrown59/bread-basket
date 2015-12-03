app.controller("MessageController", ["$scope", "MessageService", function($scope, MessageService){




	$scope.getMessages = function() {
		MessageService.all()
			.then(function(reply){
					if(reply.status === 200) {
								$scope.event = reply. data;
					}
			});
	};

	$scope.getMessageByMessageId = function(messageId) {
			MessageService.getMessageByMessageId(messageId).then(function(reply) {
				if(reply.status === 200) {
							MessageService.addAlert({type: "success", msg: reply.message});
				}else {
							MessageService.addAlert({type: "danger", msg: reply.message});
				}
				$scope.getMessage();
			});
	};

	$scope.getMessageByListingId = function(listingId) {
		MessageService.getMessageByListingId(listingId).then(function(reply) {
			if(reply.status === 200) {
				MessageService.addAlert({type: "success", msg: reply.message});
			}else {
				MessageService.addAlert({type: "danger", msg: reply.message});
			}
			$scope.getMessage();
		});
	};

	$scope.getMessageByOrgId = function(orgId) {
		MessageService.getMessageByOrgId(orgId).then(function(reply) {
			if(reply.statuss === 200) {
				MessageService.addAlert({type: "success", msg: reply.message});
			}else {
				MessageService.addAlert({type: "danger", msg: reply.message});
			}
			$scope.getMessage();
		});
	};




}])