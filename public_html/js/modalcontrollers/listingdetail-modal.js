app.controller("ListingDetailModal", ["$scope", "$uibModalInstance", "editedListing", "organization", "listingType", function($scope, $uibModalInstance, editedListing, organization, listingType) {
	$scope.editedListing = editedListing;
	$scope.organization = organization;
	$scope.listingType = listingType;
	//need to get the current organization and listing type in this scope
	//possibly in the set claimed listing in the controller
	$scope.ok = function() {
		$uibModalInstance.close($scope.editedListing, $scope.organization, $scope.listingType);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);