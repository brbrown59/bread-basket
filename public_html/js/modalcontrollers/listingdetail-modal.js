app.controller("ListingDetailModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.listing = {};



	$scope.ok = function() {

		$uibModalInstance.close($scope.listing);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);