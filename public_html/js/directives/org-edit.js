app.directive("orgEdit", ["$http", "$window", function($http, $window) {
	return {
		restrict: "E",
		link: function($scope, element, attr) {
			//all the variables this thing needs are in the controller, accessed via $scope
			//which makes them available everywhere else
			element.on("submit", function(event) {
				$scope.updateOrganization(orgId, organization)
					.then(function(reply) {
						if(typeof reply.data === "object") {
							if(reply.data.status !== 200) {
								$scope.alerts[0] = {type: "danger", msg: reply.data.message};
							} else {
								//not exactly sure what this does
								$window.location.href = $scope.redirectUrl;
							}
						}
					})
			});
			element.on("cancel", function(event) {
				//toggle the hide/show to bring up the view
			});
			//do I need to wire delete here???
		},
		//need to make this template
		templateUrl: "php/template/org-profile-edit.php"
	};
}]);