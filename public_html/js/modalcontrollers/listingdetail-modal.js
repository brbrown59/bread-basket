app.controller("ListingDetailModal", ["$scope", "$uibModalInstance", "editedListing", "organization", "listingType", function($scope, $uibModalInstance, editedListing, organization, listingType) {
	$scope.editedListing = editedListing;
	$scope.organization = organization;
	$scope.listingType = listingType;


	//need to get the current organization and listing type in this scope
	//possibly in the set claimed listing in the controller
	$scope.ok = function() {
		//this is probably wrong, and my problem
		$uibModalInstance.close($scope.editedListing);
		$uibModalInstance.close($scope.organization);
		$uibModalInstance.close($scope.listingType);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);