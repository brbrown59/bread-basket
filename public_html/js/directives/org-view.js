app.directive("orgView", function() {
	return {
		restrict: "E",
		link: function($scope, element) {
			//get the organization to fill the values
			$scope.getOrganizationById(orgId);//have to make sure I can get this ID from somewhere
			element.on("edit", function(event) {//might not need event
				//toggle the hide/show in order to bring up the edit template
				event.preventDefault();
				$scope.setEditedOrganization();
			});
			//might need to wire the delete button, too, but I'm not sure
		},
		templateUrl: "org-profile-view.php"
	};

});