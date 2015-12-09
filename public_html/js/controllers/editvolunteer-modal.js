app.controller("EditVolunteerModal", ["$scope", "$uibModalInstance", "editedVolunteer", function($scope, $uibModalInstance, editedVolunteer) {
	$scope.editedVolunteer = editedVolunteer;


	$scope.ok = function() {
		$uibModalInstance.close($scope.editedVolunteer);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);