app.controller("VolunteerModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.newVolunteer = {};


	$scope.ok = function() {
		$uibModalInstance.close($scope.newVolunteer);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);