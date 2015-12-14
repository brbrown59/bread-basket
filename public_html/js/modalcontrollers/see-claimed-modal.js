app.controller("SeeClaimedModal", ["$scope", "$uibModalInstance", "editedListing", "organization",  function($scope, $uibModalInstance, editedListing, organization) {
	$scope.editedListing = editedListing;
	$scope.organization = organization;

	$scope.ok = function() {
		$uibModalInstance.close($scope.editedListing);
		$uibModalInstance.close($scope.organization);
	}
}]);