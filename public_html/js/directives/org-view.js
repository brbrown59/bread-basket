app.directive("orgView", function() {
	return {
		//have to call the getOrganizationById at some point
		restrict: "E",
		link: function($scope, element) {
			$scope.getOrganizationById(302);
		},

		templateUrl: "org-profile-view.php"
	};

});