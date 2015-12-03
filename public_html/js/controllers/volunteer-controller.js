app.controller("VolunteerController", ["$scope", "$uibModal", "VolunteerService", function($scope, $uibModal, VolunteerService) {
	$scope.volData = {};
	$scope.editedVolunteer = {};
	$scope.newVolunteer = {volId: null, volEmail: "", volEmailActivation: "", volFirstName: "", volIsAdmin: false, volLasName: "", volPhone: ""} //EMAIL ACTIVATION????
	$scope.isEditing = false;
	$scope.alerts = [];
	$scope.volunteers = [];

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
	 * fufills the promise from retrieving the volunteers from the volunteer API
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

	/**
	 * creates a volunteer and sends it to the volunteer API
	 *
	 * @param volunteer
	 */


	//opens the new volunteer Modal to enter new volunteer information
	$scope.openVolunteerModal = function () {
		var VolunteerModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newvolunteer-modal.php",
			controller: "VolunteerModal",
			resolve: {
				volData : function () {
					return($scope.volData);
				}
			}
		});
	}
}]);