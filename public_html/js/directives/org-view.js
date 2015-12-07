//todo: there's two ways to cancel an edit: cancel, and submit.  Account for both...in which directive?
//the template will use the {{variable}} syntax to dynamically get values
//look into ng-if

app.directive("orgView", ["$http", "$window", "OrganizationService", function($http, $window, OrganizationService) {
	return {
		restrict: "E",
		link: function($scope, element, attr) {

		},
		templateUrl: "php/template/org-profile-view.php"
	};

}]);