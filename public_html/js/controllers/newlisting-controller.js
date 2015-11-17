app.controller("NewListingController", ["$scope", "$uibModal", function($scope, $uibModal) {
	$scope.listingData = {};

	$scope.openListingModal = function () {
		var ListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/signup-modal.php",
			controller: "SignupModal",
			resolve: {
				signinData : function () {
					return($scope.listingData);
				}
			}
		});
	}
}]);