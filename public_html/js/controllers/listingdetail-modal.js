app.controller("ListingDetailModal", ["$scope", "$uibModalInstance", "DetailListing", function($scope, $uibModalInstance, detailListing) {
	$scope.detailListing = detailListing;


	$scope.ok = function() {
		$uibModalInstance.close($scope.detailListing);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);