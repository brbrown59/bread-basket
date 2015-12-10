app.controller("VoulunteerController", ["$scope", "$ubiModal", "ListingService", "OrganizationService", "AlertService", function($scope, $ubiModal, ListingService, OrganizationService,AlertService) {
	$scope.editedListing
	$scope.index = null;
	$scope.alerts = [];
	$scope.listings = [];

	/**
	 * opens detail listing modal and allows user to update listing as claimed or not claimed
	 */

	$scope.openListingModal = function() {
		var ListingModalInstance = $ubiModal.open({
			templateUrl: "../../js/views/listing-detailview-modal.php",
			controller: "listingModal",
			resolve: {
				volunteer: function() {
					return ($scope.listings);
				}
			}
		});
		ListingModalInstance.result.then(function(listing){

			ListingService.create(listing)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg: result.data.message};
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
			//push the new voulunteer into the array o update live
			$scope.listings.push(listing);
		});
	};




}])