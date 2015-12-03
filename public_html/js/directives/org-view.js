app.directive("orgView", ["$http", "$window", function($http, $window) {
	return {
		restrict: "E",
		link: function($scope, element, attr) {
			element.on("submit", function(event) {//should this be submit? or something else?
				event.preventDefault(); //what does this do, and do I need it?
				//call the org controller here (do I have to pass this in?)
				//how do I call it, and how do I get it in this scope
				OrganizationController.cancelEditing(); //this CAN'T be right
				OrganizationController.getOrganizationById(orgId)//id has to come from somewhere...
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