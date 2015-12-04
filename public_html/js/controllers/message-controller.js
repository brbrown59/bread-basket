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

	// create new organazation
$scope.createMessage = function(message, validated) {
	if(validated === true) {
		MessageService.create(organization)
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.alerts[0] = {type: "success", msg: result.data.message};
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	}
};

//update the organization
	$scope.updateMessage = function(message, validate) {
		if(validate === true && $scope.isEditing === true) {
			MessageService.update(organization.messageId, message)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					}else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	//delete the message
	$scope.deleteMessage = function(messageId) {
		//create a modal to ask for confirmation
		var message = "do you really want to delete this message?";
		var modalHtml = '<div class="modal-body">' + message + ' </div><div class="modal-footer"><button class="btn btn-primary" ng-click="yes()">Yes</button><button class="btn-warning" ng-click"no()">No</button></div>';
		var modalInstance = $uibModal.open({
			template: modalHtml,
			controller: ModalInstanceCtrl
		});

		//if yes is selceted, delet the message
		modalInstance.result.then(function() {
			MessageService.destroy(messageId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type:"success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				})
		});
	};

}]);

//modal instance controller for deleting prompt
var modalInstanceCtrl = function($scope, $ubiModalInstance) {
	$scope.yes =function() {
		$ubiModalInstance.dismiss('cancel');
	};
	$scope.no = function() {
		$ubiModalInstance.dismiss('cancel');
	};
};

