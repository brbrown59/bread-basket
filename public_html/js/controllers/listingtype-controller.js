/**
 * A service for listingtype
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributing code from Misquote @author Dylan McDonald
 */

app.controller("ListingTypeController", ["$scope", "$uibModal", "ListingTypeService", "AlertService", function($scope, ListingTypeService, AlertService) {
	//add as needed
	$scope.listingTypes = [];
	$scope.alerts = [];
	$scope.editedListingTypes = [];


	/**
	 * opens new listingType modal and adds sends listingType to the listingType API
	 */

	$scope.openListingModal = function() {
		var ListingModalInstance = $uibModal.open({
			templateUrl: "../../js/views/newlisting-modal.php",
			controller: "ListingModal",
			resolve: {
				listingType: function() {
					return ($scope.listingType);
				}
			}
		});
	}

	//get listingType from API REST Endpoint
	//come back for the other gets
	//make docblocks better when I know more
	$scope.getListingType = function() {
		ListingTypeService.all()
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.listingTypes = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
	};

	$scope.getListingTypeById = function(listingTypeId, validated) {
		if(validated === true) {
			ListingTypeService.fetch(listingTypeId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
		}
	};

	// Get Listing Type By Listing Type Info
	$scope.getListingTypeByListingTypeInfo = function(listingType, validated) {
		if(validated === true) {
			ListingTypeService.fetchListingTypeInfo(listingTypeInfo)
					.then(function(result) {
				if(result.data.status === 200) {
					$scope.listingTypes = result.data.data;
				} else {
					$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			});
		}
	};

	// create new listing type (POST)
	$scope.createListingType = function(listingType, validated) {
		if(validated === true) {
			ListingTypeService.create(listingType)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	// update a listing type (PUT)
	$scope.updateListingType = function(listingType, validated) {
		if(validated === true && $scope.isEditing === true) {
			ListingTypeService.update(listingType.listingTypeId, ListingTypeInfo)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	// delete a listing type (DELETE)
	$scope.deleteListingType = function(listingTypeId) {
		// create a modal to ask for confirmation. should be wired to listing modal
		var message = "Do you really want to delete this Listing Type?";
		var modalHtml = '<div class="modal-body">' + message + '</div><div class="modal-footer"><button class="btn btn-primary" ng-click="yes()">Yes</button><button class="btn btn-warning" ng-click="no()">No</button></div>';
		var modalInstance = $uibModal.open({
			template: modalHtml,
			controller:ModalInstanceCtrl
		});

		//if yes is selected, delete the listingType
		modalInstance.result.then(function() {
			ListingTypeService.destroy(listingTypeId)
					.then(function(result) {
						if(result.data.status === 200) {
					$scope.alerts[0] = {type: "success", msg: result.data.message};
				} else {
				$scope.alerts[0] = {type: "danger", msg: result.data.message};
				}
			})
		});
	};
}]);



//modal instance controller for deletion prompt
var ModalInstanceCtrl = function($scope, $uibModalInstance) {
	$scope.yes = function() {
		$uibModalInstance.close();
	};
	$scope.no = function() {
		$uibModalInstance.dismiss('cancel');
	};
};




