/**
 * A service for listingtype
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributing code from Misquote @author Dylan McDonald
 */

app.controller("ListingTypeController", ["$scope", "$uibModal", "ListingTypeService", function($scope, ListingTypeService) {
	//add as needed
	$scope.listingTypes = [];
	$scope.alerts = [];

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

	$scope.


}])