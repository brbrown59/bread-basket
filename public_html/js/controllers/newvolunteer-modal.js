app.controller("VolunteerModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.volData = {};
	$scope.newVolunteer = {};

	$scope.ok = function() {
		$uibModalInstance.close($scope.volData);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);