//todo: there's two ways to cancel an edit: cancel, and submit.  Account for both...in which directive? it's based on hide and show

app.directive("orgEdit", ["$http", "$window", function($http, $window) {
	return {
		restrict: "E",
		link: function($scope, element, attr) {
			//need to account for cancel editing case, and somehow need to switch back to the view
			//probably though the is-editing boolean
			//but, all the variables this thing needs are in the controller, accessed via $scope
			//which makes them available everywhere else
			element.on("submit", function(event) {
				$scope.updateOrganization(orgId, organization)
					.then(function(reply) {
						if(typeof reply.data === "object") {
							if(reply.data.status !== 200) {
								$scope.alerts[0] = {type: "danger", msg: reply.data.message};
							} else {
								//not exactly sure what this does; does this redirect me to the view?
								$window.location.href = $scope.redirectUrl;
							}
						}
					})
			});
		},
		//need to make this template
		templateUrl: "php/template/org-profile-edit.php"
	};
}]);