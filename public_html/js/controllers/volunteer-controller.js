app.controller("NewVolunteerController", ["$scope", "$uibModal", function($scope, $uibModal) {
	$scope.volData = {};

	$scope.openVolunteerModal = function () {
		var ListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newvolunteer-modal.php",
			controller: "VolunteerModal",
			resolve: {
				listingData : function () {
					return($scope.volData);
				}
			}
		});
	}
}]);