app.controller("ListingController", ["$scope", "$uibModal", "ListingService", "AlertService", function($scope, $uibModal,ListingService, AlertService) {
	$scope.ListingData = {};
	$scope.listing = {listingId: null, description: "", estimatedCost: "",  listingType: ""}//todo are these the correct fields?
	$scope.isEditing = false;
	$scope.alerts = [];
	$scope.listings = [];
	$scope.listingTypes = [];//Todo is linking both correct?

	/**
	 * opens new listing modal and adds sends listing to the volunteer API
	 */

	$scope.openListingModal = function() {
		var ListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newlisting-modal.php",
			controller: "ListingModal",
			resolve: {
				listing : function() {
					return($scope.listing);
				}
			}
		});
		ListingModalInstance.result.then(function (listing) {
			$scope.listing = listing;
			ListingService.create(listing)
					.then(function(reply) {
						if(reply.status ===200){
						AlertService.addAlert({type: "success", msg: reply.message});
					} else {
						AlertService.addAlert({type: "danger", msg: reply.message});
					}
			});
	}, function() {
		$scope.listing = {};
	});
	};

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
	 * sets which listing is being edited and activates the editing form
	 *
	 * @param newListing the listing to be edited
	 */

	$scope.setEditedListing = function(listing) {
		$scope.isEditing = true;
	};

	/**
	 * cancels editing doesn't change listing being edited
	 */
	$scope.cancelEditing = function() {
		$scope.editedListing = {};
		$scope.isEditing = false;
	};

	/**
	 * fulfills the promise from retrieving all the listings from the listing API
	 */
	$scope.getListing = function() {
		ListingService.all()
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.listings = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
	};

	/**
	 * fulfills the promise from retrieving the listing by Id from the listing API
	 */
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
	$scope.getListingByOrgId = function(orgId, validated) {
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

}]);