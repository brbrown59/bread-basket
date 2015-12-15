app.controller("SignupModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.signupData = {orgState: "NM", orgCity: "Albuquerque"};

	$scope.ok = function() {
		$uibModalInstance.close($scope.signupData);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);