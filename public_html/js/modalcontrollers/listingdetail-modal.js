app.controller("ListingDetailModal", ["$scope", "$uibModalInstance", "editedListing", function($scope, $uibModalInstance, editedListing) {
	$scope.editedListing = editedListing;



	$scope.ok = function() {
		$uibModalInstance.close($scope.editedListing);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);