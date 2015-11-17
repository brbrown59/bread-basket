app.controller("NewListingController", ["$scope", "$uibModal", function($scope, $uibModal) {
	$scope.listingData = {};

	$scope.openListingModal = function () {
		var ListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newlisting-modal.php",
			controller: "ListingModal",
			resolve: {
				signinData : function () {
					return($scope.listingData);
				}
			}
		});
	}
}]);