app.controller("ListingDetailModal", ["$scope", "$uibModalInstance", "editedListing", function($scope, $uibModalInstance, editedListing) {
	$scope.editedListing = editedListing;
	//need to get the current organization and listing type in this scope
	$scope.ok = function() {
		$uibModalInstance.close($scope.editedListing);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);