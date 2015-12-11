app.controller("ListingController", ["$scope", "$uibModal", "ListingService", "AlertService", "Pusher", function($scope, $uibModal,ListingService, AlertService, Pusher) {
	$scope.editedListing = {};
	$scope.alerts = [];
	$scope.listings = [];

	/**
	 * opens detail listing modal and allows user to update listing as claimed or not claimed
	 */

	$scope.openListingDetailModal = function() {
		var ListingDetailModalInstance = $uibModal.open({
			templateUrl: "../../js/views/listing-detailview-modal.php",
			controller: "ListingDetailModal",
			resolve: {
				listing: function() {         //this line was volunteers. I'm not entirely sure it should be listing
					return ($scope.listings);
				}
			}
		});
		ListingDetailModalInstance.result.then(function(listing) {
			$scope.listing = listing;
			ListingService.create(listing)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		});
	};


	/**
	 * opens new listing modal and adds sends listing to the listing API
	 */

	$scope.openListingModal = function() {
		var ListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newlisting-modal.php",
			controller: "ListingModal",
			resolve: {
				listing: function() {
					return ($scope.listings);
				}
			}
		});
		ListingModalInstance.result.then(function(listing) {
			ListingService.create(listing)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
			//push the new listing into he array to update live
			$scope.listings.push(listing);
		});
	};




	/**
	 * sets which listing is being edited and activates the editing form
	 *
	 *
	 */

	$scope.setEditedListing = function() {
		$scope.isEditing = true;
		$scope.openEditListinglModal();
	};

	/**
	 * cancels editing doesn't change listing being edited
	 */
	$scope.cancelEditing = function() {
		$scope.editedListing = {};
		$scope.isEditing = false;
	};

	/**
	 * opens edit listing modal and allows user to update listing as claimed or not claimed
	 */

	$scope.openEditListingModal = function() {
		var EditListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/editlisting-modal.php",
			controller: "EditListingModal",
			resolve: {
				listing: function() {        //TODo should this be volunteer for some reason I don't see?
					return ($scope.listing);
				}
			}
		});

		ListingDetailModalInstance.result.then(function(listing) { //todo is there something wrong with ListingDetailModalInstance?
			$scope.listing = listing;
			ListingService.create(listing)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		});
	};

	/**
	 * fulfills the promise from retrieving all the listings from the listing API
	 */
	$scope.getListings = function() {
		ListingService.all()
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.listings = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
	};

	//load the array on first view
	if($scope.listings.length === 0) {
		$scope.listings = $scope.getListings();
	}

	/**
	 * creates a listing and sends it to the listing API
	 *
	 * @param listing the listing to send
	 * @param validated true is angular validated the form, false if not
	 */
	$scope.createListing = function(listing, validated) {
		if(validated === true) {
			ListingService.create(listing)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};







	/**
	 * fulfills the promise from retrieving the listing by Id from the listing API
	 */
	//This promise at one point removed the alert box and would break the New Listing drop down
	$scope.getListings = function() {
		ListingService.fetchId()
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.listings = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
	};

	//fulfills the promise from retrieving the listing by org id
	$scope.getListingsByOrgId = function(orgId, validated) {
		if(validated === true) {
			ListingService.fetchOrgId(orgId)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.listings = result.data.data;
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	//fulfills the promise from retrieving the listings by parent id
	$scope.getListingByParentId = function(parentId, validated) {
		if(validated === true) {
		ListingService.fetchParentId(parentId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.listings = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	//fulfills the promise from retrieving the listings by post time
	$scope.getListingByPostTime = function(postTime, validated) {
		if(validated === true) {
			ListingService.fetchPostTime(postTime)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.listings = result.data.data;
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	//fulfills the promise from retrieving the listings by Type Id
	$scope.getListingByTypeId = function(typeId, validated) {
		if(validated === true) {
			ListingService.fetchTypeId(typeId)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.listings = result.data.data;
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	/**
	 * updates a listing and sends it to the listing API
	 *
	 * @param listing the listing to send
	 * @param validated true is angular validated the form, false if not
	 */
	$scope.updateListing = function(listing, validated) {
		if(validated === true && $scope.isEditing === true) {
			ListingService.update(listing.listingId, listing)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	/**
	 * deletes a listing and sends it to the listing API if the user confirms deletion
	 *
	 * @param listingId the listing id of the listing to be deleted
	 */
	$scope.deleteListing = function(listingId) { //Todo Add , index
		//create a modal instance to prompt the user if she/he is sure they want to delete the listing
		var message = "Are you sure you want to delete this listing?";

		var modalHtml = '<div class="modal-body">' + message + '</div><div class="modal-footer"><button class="btn btn-primary" ng-click="yes()">Yes</button><button class="btn btn-warning" ng-click="no()">No</button></div>';

		var modalInstance = $uibModal.open({
			template: modalHtml,
			controller: ModalInstanceCtrl
		});

		//if the user clicked yes, delete the listing
		modalInstance.result.then(function() {
			ListingService.destroy(listingId)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
			//remove the current listing from array //Todo commented out while figuring out how I broke it
			//$scope.listing.splice(index, 1);
		});
	};

	//subscribe to the delete channel; this will delete from the listings array on demand
	Pusher.subscribe("listing", "delete", function(listing){
		for(var i = 0; i < $scope.listings.length; i++) {
			if($scope.listings[i].listingId ===listing.listingId) {
				$scope.listings.splice(i, 1);
				break;
			}
		}
	});

	//subscribe to the new channel; this will add to the listings array on demand
	Pusher.subscribe("listing", "new", function(listing){
		$scope.listings.push(listing);
	});

	//subscribe to the update channel; this will update the listings array on demand
	Pusher.subscribe("listing", "update", function(listing){
		for(var i = 0; i < $scope.listings.length; i++) {
			if($scope.listings[i].listingId === listing.listingId) {
				$scope.listings[i] = listing;
				break;
			}
		}
	});

	//when the window is closed/reloaded, gracefully close the channel
	$scope.$on("$destroy", function() {
		Pusher.unsubscribe("listings");
	});


}]);

//embedded modal instance controller to create deletion prompt
var ModalInstanceCtrl = function($scope,  $uibModalInstance) {
	$scope.yes = function() {
		$uibModalInstance.close();
	};

	$scope.no = function() {
		$uibModalInstance.dismiss('cancel');
	};
};