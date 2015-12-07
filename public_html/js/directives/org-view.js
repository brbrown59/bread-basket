app.directive("orgView", ["$http", "$window", function($http, $window) {
	return {
		restrict: "E",
		link: function($scope, element, attr) {
			//get the organization to fill the values; this inserts it into the scope, which should allow the binding in the template
			//to access it and populate the page
			$scope.getOrganizationById(orgId)//have to make sure I can get this ID from somewhere
			//need to figure out how to switch to the editing view, probably in this template
			//element.on edit???
		},
		templateUrl: "php/template/org-profile-view.php"
	};

}]);