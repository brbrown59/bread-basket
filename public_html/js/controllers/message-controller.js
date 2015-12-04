app.controller("MessageController", ["$scope", "uibModal", "MessageService", function($scope, MessageService){
	//add as needed
	$scope.messages = [];
	$scope.alerts = [];

	//get messages frmo API
	//come back for the other gets
	//make docblocks better
	$scope.getMessages = function() {
		MessageService.all()
			.then(function(result){
				if(result.data.status === 200) {
					$scope.messages =result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	};

	$scope.getMessagesById = function(messageid, validated) {
		if(validate === true){
			MessageServices.fetch(messageId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.messages = result.data.data;
					} else{
						$scope.alerts[0] = {type: "danger", msg:result.data.message}
					}
				});
		}
	};

	$scope.getMessagesByListingId = function(listingId, validated){
		if(validated === true){
			MessageService.fetch()(listingId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.messages = result.data.data;
					} else{
						$scope.alerts[0] = {type: "danger", msg:result.data.message}
					}
				});
		}
	};

	$scope.getMessageByOrgId = function(orgId, validated){
		if(validated === true){
			MessageService. fetch()(ordId)
				.then(function(result){
					if(result.data.status === 200) {
						$scope.messages = result.data.data;
					} else{
						$scope.alerts[0] = {type: "danger", msg:result.data.message}
					}
				});
		}
	};

	$scope.getMessageByMessageText = function(messageText, validated) {
		if(validated === true){
			MessageService. fetch()(messageText)
				.then(function(result){
					if(result.data.status === 200) {
						$scope.messages = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg:result.data.message}
					}
				});
		}
	};
















}])