app.controller("SeeClaimedModal", ["$scope", "$uibModalInstance", "editedListing", "organization", "volunteer", function($scope, $uibModalInstance, editedListing, organization, volunteer) {
	$scope.editedListing = editedListing;
	$scope.organization = organization;
	$scope.volunteer = volunteer;

	$scope.ok = function() {
		$uibModalInstance.close($scope.editedListing);
		$uibModalInstance.close($scope.organization);
		$uibModalInstance.close($scope.volunteer);
	}
}]);