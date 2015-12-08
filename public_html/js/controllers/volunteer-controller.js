app.controller("VolunteerController", ["$scope", "$uibModal", "VolunteerService", "AlertService", function($scope, $uibModal, VolunteerService, AlertService) {
	$scope.editedVolunteer = {};
	$scope.isEditing = false;
	$scope.alerts = [];
	$scope.volunteers = [];


	/**
	 * opens new volutneer modal and adds sends volunteer to the volunteer API
	 */

	$scope.openVolunteerModal = function () {
		var VolunteerModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newvolunteer-modal.php",
			controller: "VolunteerModal",
			resolve: {
				volunteer: function() {
					return ($scope.volunteer);
				}
			}
		});
		VolunteerModalInstance.result.then(function(volunteer) {
			$scope.volunteer = volunteer;
			VolunteerService.create(volunteer)
					.then(function(reply) {
						console.log("STATUS: " + reply.data.status);
						console.log("MSG: " + reply.data.message + "(not monosodium glutamate)");
						if(reply.data.status === 200) {
							console.log("yes");
							AlertService.addAlert({type: "success", msg: reply.data.message});
						} else {
							console.log("no");
							AlertService.addAlert({type: "danger", msg: reply.data.message});
						}
					});
		}, function() {
			$scope.volunteer = {};
		});
	};

	/**
	 * sets which volunteer is being edited and activates the editing form
	 *
	 * @param volunteer the volunteer to be edited
	 */
	$scope.setEditedVolunteer = function(volunteer) {
		$scope.isEditing = true;
	};

	/**
	 * cancels editing doesn't change volunteer being edited
	 */
	$scope.cancelEditing = function() {
		$scope.editedVolunteer = {};
		$scope.isEditing = false;
	};

	/**
	 * fufills the promise from retrieving all the volunteers from the volunteer API
	 */
	$scope.getVolunteers = function() {
		VolunteerService.all()
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.volunteers = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
	};

	// load the array on first view
	if($scope.volunteers.length === 0) {
		$scope.volunteers = $scope.getVolunteers();
	}

	///**
	// * fufills the promise from retrieving the volunteers BY ID  from the volunteer API
	// */
	//$scope.getVolunteers = function() {
	//	VolunteerService.fetchId()
	//			.then(function(result) {
	//				if(result.data.status === 200) {
	//					$scope.volunteers = result.data.data;
	//				} else {
	//					$scope.alerts[0] = {type: "danger", msg: result.data.message};
	//				}
	//			});
	//};
	//
	///**
	// * fufills the promise from retrieving the volunteers BY EMAIL from the volunteer API
	// */
	//$scope.getVolunteers = function() {
	//	VolunteerService.fetchEmail()
	//			.then(function(result) {
	//				if(result.data.status === 200) {
	//					$scope.volunteers = result.data.data;
	//				} else {
	//					$scope.alerts[0] = {type: "danger", msg: result.data.message};
	//				}
	//			});
	//};
	//
	///**
	// * fufills the promise from retrieving the volunteers BY ADMIN from the volunteer API
	// */
	//$scope.getVolunteers = function() {
	//	VolunteerService.fetchAdmin()
	//			.then(function(result) {
	//				if(result.data.status === 200) {
	//					$scope.volunteers = result.data.data;
	//				} else {
	//					$scope.alerts[0] = {type: "danger", msg: result.data.message};
	//				}
	//			});
	//};
	//
	///**
	// * fufills the promise from retrieving the volunteers BY PHONE from the volunteer API
	// */
	//$scope.getVolunteers = function() {
	//	VolunteerService.fetchPhone()
	//			.then(function(result) {
	//				if(result.data.status === 200) {
	//					$scope.volunteers = result.data.data;
	//				} else {
	//					$scope.alerts[0] = {type: "danger", msg: result.data.message};
	//				}
	//			});
	//};

	/**
	 * updates a volunteer and sends it to the volunteer API
	 *
	 * @param volunteer the volunteer to send
	 * @param validated true if angular validated the form, false if not
	 */
	$scope.updateVolunteer = function(volunteer, validated) {
		if(validated === true && $scope.isEditing === true) {
			VolunteerService.update(volunteer.volId, volunteer)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});


		}
	};

	/**
	 * deletes a volunteer and sends it to the volunteer API if the user confirms deletion
	 *
	 * @param volId the volunteer id to delete
	 */
	$scope.deleteVolunteer = function(volId) {
		//create a modal instance to prompt the user if she/he is sure they want to delete the misquote
		var message = "Are you sure you want to delete this volunteer?";

		var modalHtml = '<div class="modal-body">' + message + '</div><div class="modal-footer"><button class="btn btn-primary" ng-click="yes()">Yes</button><button class="btn btn-warning" ng-click="no()">No</button></div>';

		var modalInstance = $uibModal.open({
			template: modalHtml,
			controller: ModalInstanceCtrl
		});

		//if the user clicked yes, delete the volunteer
		modalInstance.result.then(function () {
			VolunteerService.destroy(volId)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					})
		});
	};

}]);

// embedded modal instance controller to create deletion prompt
var ModalInstanceCtrl = function($scope, $uibModalInstance) {
	$scope.yes = function() {
		$uibModalInstance.close();
	};

	$scope.no = function() {
		$uibModalInstance.dismiss('cancel');
	};
};