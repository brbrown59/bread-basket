app.controller("ListingController", ["$scope", "$uibModal", "ListingService", "AlertService", function($scope, $uibModal,ListingService, AlertService) {
	$scope.ListingData = {};
	$scope.newListing = {listingId: null, description: "", estimatedCost: "",  listingType: ""}//todo are these the correct fields?
	$scope.isEditing = false;
	$scope.alerts = [];
	$scope.listings = [];
	$scope.listingTypes = [];//Todo is linking both correct?


	$scope.openListingModal = function () {
		var ListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newlisting-modal.php",
			controller: "ListingModal",
			resolve: {
				newListing : function () {
					return($scope.newListing);
				}
			}
		});
		ListingModalInstance.result.then(function (newListing) {
			$scope.newListing = newListing;
			ListingService.create(newListing)
					.then(function(reply) {
						if(reply.status ===200){
						AlertService.addAlert({type: "success", msg: reply.message});
					} else {
						AlertService.addAlert({type: "danger", msg: reply.message});
					}
			});
	}, function() {
		$scope.newListing = {};
	});
	};

	/**
	 * sets which listing is being edited and activates the editing form
	 *
	 * @param newListing the listing to be edited
	 */

	$scope.setEditedListing = function(newListing) {
		$scope.isEditing = true;
	};

	/**
	 * cancels editing doesn't change listing being edited
	 */
	$scope.cancelEditing = function() {
		$scope.editedListing = {};
		$scope.isEditing = false;
	};

}]);