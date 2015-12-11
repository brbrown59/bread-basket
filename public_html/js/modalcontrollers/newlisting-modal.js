app.controller("ListingModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.listingData = {};

	$scope.ok = function() {
		$uibModalInstance.close($scope.listingData);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);