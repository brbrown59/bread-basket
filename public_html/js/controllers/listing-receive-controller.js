app.controller("ListingController", ["$scope", "$uibModal", "ListingService", "OrganizationService", "AlertService", function($scope, $uibModal, ListingService, OrganizationService,AlertService) {
	$scope.editedListing = {};
	$scope.index = null;
	$scope.alerts = [];
	$scope.listings = [];

	/**
	 * opens detail listing modal and allows user to update listing as claimed or not claimed
	 */

	$scope.openListingModal = function() {
		var ListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newlisting-modal.php",
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

	/** ??????do we need this block???????
	 * opens edit listing modal and sends updated to the volunteer API
	 */

	$scope.openEditlistingModal = function() {
		var EditlistingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/editListing-modal.php",
			controller: "EditListingModal",
			resolve: {
				editedListing: function() {
					return ($scope.editedListing);
				}
			}
		});

		EditlistingModalInstance.result.then(function(listing) {

			LisitngService.create(lisitng)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "success", msg:result.data.message}
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
			//push the new listing inot the array to update in real time
			$scope.listing.push(listing);
		});
	};

	/**??????do we need this block?????????
	 * opens edit listing modal and sends updated volunteer to the volunteer API
	 */

	$scope.openEditlistingModal = function() {
		var EditListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/editListing-modal.php",
			controller: "EditListingModal",
			resolve: {
				editedListing:function() {
					return ($scope.editiedListing);
				}
		}
		});
		EditListingModalInstance.result.then(function(lisitng) {
			//send the update request to the database
			ListingService.update(listing.listingId, listing)
				.then (function(result) {
				if(result.data.status === 200) {
					$scope.alert[0] = {type: "success", msg: result.data.message};
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
			//update angulars copy for dynamic tables updates
			$scope.editedListing = angular.copy(listing);
			$scope.index = index;
			$scope.openEditListingModal();
		});

		/**
		 * fulfills the promise from retrieving all the volunteers form the listing API
		 */
		$scope.getListing = function() {
			ListingService.all()
				.then(function(result) {

				})
		}



	}

}])