app.controller("VolunteerController", ["$scope", "$uibModal", "VolunteerService", "AlertService", function($scope, $uibModal, VolunteerService, AlertService) {
	$scope.editedVolunteer = {};
	$scope.newVolunteer = {misquoteId: null, volFirstName: "", volLastName: "", volEmail: "", volPhone: ""};
	$scope.alerts = [];
	$scope.volunteers = [];

	/**
	 * opens new volutneer modal and adds sends volunteer to the volunteer API
	 */

	$scope.openVolunteerModal = function() {
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
					if(reply.data.status === 200) {
						AlertService.addAlert({type: "success", msg: reply.data.message});
					} else {
						AlertService.addAlert({type: "danger", msg: reply.data.message});
					}
				});
		}, function() {
			$scope.volunteer = {};
		});
	};


	/**
	 * opens edit volunteer modal and sends updated volunteer to the volunteer API
	 */

	$scope.openEditVolunteerModal = function() {
		var EditVolunteerModalInstance = $uibModal.open({
			templateUrl: "../../js/views/editvolunteer-modal.php",
			controller: "EditVolunteerModal",
			resolve: {
				editedVolunteer: function() {
					//console.log($scope.editedVolunteer);
					return ($scope.editedVolunteer);
				}
			}
		});
		EditVolunteerModalInstance.result.then(function(volunteer) {
			console.log(volunteer);
			VolunteerService.update(volunteer.volId, volunteer)
				.then(function(reply) {
					if(reply.data.status === 200) {
						AlertService.addAlert({type: "success", msg: reply.data.message});
					} else {
						AlertService.addAlert({type: "danger", msg: reply.data.message});
					}
				});
		}, function() {
			$scope.volunteer = {};
		});
	};

	$scope.setEditedVolunteer = function(volunteer) {
		$scope.editedVolunteer = angular.copy(volunteer);
		//console.log($scope.editedVolunteer);
		$scope.openEditVolunteerModal();
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

	/**
	 * fufills the promise from retrieving the volunteers BY ID  from the volunteer API
	 */
	$scope.getVolunteersById = function() {
		VolunteerService.fetchId()
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.volunteers = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	};

	/**
	 * fufills the promise from retrieving the volunteers BY EMAIL from the volunteer API
	 */
	$scope.getVolunteersByEmail = function() {
		VolunteerService.fetchEmail()
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.volunteers = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	};

	/**
	 * fufills the promise from retrieving the volunteers BY ADMIN from the volunteer API
	 */
	$scope.getVolunteersByIsAdmin = function() {
		VolunteerService.fetchAdmin()
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.volunteers = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
	};

	/**
	 * fufills the promise from retrieving the volunteers BY PHONE from the volunteer API
	 */
	$scope.getVolunteersByPhone = function() {
		VolunteerService.fetchPhone()
			.then(function(result) {
				if(result.data.status === 200) {
					$scope.volunteers = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
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
		modalInstance.result.then(function() {
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