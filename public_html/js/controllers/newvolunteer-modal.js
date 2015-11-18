app.controller("VolunteerModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.volData = {};

	$scope.ok = function() {
		$uibModalInstance.close($scope.volData);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);