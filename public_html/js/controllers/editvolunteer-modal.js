app.controller("EditVolunteerModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.editedVolunteer = {};

	$scope.ok = function() {
		$uibModalInstance.close($scope.editedVolunteer);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);