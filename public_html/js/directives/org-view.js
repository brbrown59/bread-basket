app.directive("orgView", ["$http", "$window", "OrganizationService", function($http, $window, OrganizationService) {
	return {
		restrict: "E",
		link: function($scope, element, attr) {
			element.on("submit", function(event) {//should this be submit? or something else?
				event.preventDefault();
				//call the service to fetch the information for this organization to display
				OrganizationService.fetch(orgId)//ID should come from the logged-in volunteer data
					.then(function(reply) {
					if(typeof reply.data === "object") {
						if(reply.data.status !== 200) {
							$scope.alerts[0] = {type: "danger", msg: reply.data.message};
						} else {
							$window.location.href = $scope.redirectUrl;
						}
					}
				})
			});
		},
		templateUrl: "php/template/org-profile-view.php" //connect to the organization template
	};
}]);