app.controller("SigninModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.signinData = {};

	$scope.ok = function() {
		$uibModalInstance.close($scope.signinData);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);