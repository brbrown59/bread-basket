app.directive("listingView", function() {
	return {
		restrict: "E",
		link: function($scope, element) {
			//this (obviously) needs to change to get ID of the listing
			//$scope.getCurrentOrganization();
		},

		templateUrl: "detail-view.php"
	};

});