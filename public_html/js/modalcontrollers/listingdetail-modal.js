app.controller("ListingDetailModal", ["$scope", "$uibModalInstance", "editedListing", function($scope, $uibModalInstance, editedListing) {
	$scope.editedListing = editedListing;


	//need to get the current organization and listing type in this scope
	//possibly in the set claimed listing in the controller
	$scope.ok = function() {
		$uibModalInstance.close($scope.editedListing);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);