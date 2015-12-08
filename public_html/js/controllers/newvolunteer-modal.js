app.controller("VolunteerModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.volunteer = {};


	$scope.ok = function() {
		$uibModalInstance.close($scope.volunteer);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);