app.controller("ListingController", ["$scope", "$ubiModal", "ListingService", "OrganizationService", "AlertService", function($scope, $ubiModal, ListingService, OrganizationService,AlertService) {
	$scope.editedListing = {};
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
			//push the new listing into the array to update in real time
			$scope.listings.push(listing);
		});
	};

	/**
	 * opens edit listing modal and sends updated to the volunteer API
	 */

	$scope.openEditlistingModal = function() {
		var EditlistingModalInstance = $ubiModal.open({
			templateUrl: "../../js/views/editListing-modal.php",
			controller: "EditListingModal",
			resolve: {
				editedListing: function() {
					return ($scope.editedListing);
				}
			}
		});

		EditlistingModalInstance


	}




}])