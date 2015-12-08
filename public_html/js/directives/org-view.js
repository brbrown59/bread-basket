app.directive("orgView", function() {
	return {
		restrict: "E",
		link: function($scope, element) {
			//need the actual ID: either run a function to get it here, or retrieve it from the scope
			$scope.getCurrentOrganization();
		},

		templateUrl: "org-profile-view.php"
	};

});