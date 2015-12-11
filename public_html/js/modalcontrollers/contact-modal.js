app.controller("ContactModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.contactData = {};

	$scope.ok = function() {
		$uibModalInstance.close($scope.contactData);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);