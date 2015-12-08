app.controller("OrganizationController", ["$scope", "OrganizationService", "$uibModal", function($scope, OrganizationService, $uibModal) {
	//add as needed

	//the organization for the view will be the first element in this array
	$scope.organization = "";
	$scope.alerts = [];
	$scope.redirectUrl = "";
	$scope.isEditing = false;

	$scope.setEditedOrganization = function() {
		$scope.isEditing = true;
	};

	/**
	 * cancels editing and clears out the misquote being edited
	 **/
	$scope.cancelEditing = function() {
		$scope.isEditing = false;
	};

	$scope.getOrganizations = function() {
		OrganizationService.all()
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.organizations = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
	};

	$scope.getOrganizationById = function(orgId) {
		OrganizationService.fetchId(orgId)
				.then(function(result) {
					if(result.data.status === 200) {
						$scope.organization = result.data.data;
					} else {
						$scope.alerts[0] = {type: "danger", msg: result.data.message};
					}
				});
	};

	$scope.getOrganizationByCity = function(orgCity, validated) {
		if(validated === true) {
			OrganizationService.fetchCity(orgCity)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.organizations = result.data.data;
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	$scope.getOrganizationByName = function(orgName, validated) {
		if(validated === true) {
			OrganizationService.fetchName(orgName)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.organizations = result.data.data;
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	$scope.getOrganizationByState = function(orgState, validated) {
		if(validated === true) {
			OrganizationService.fetchState(orgState)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.organizations = result.data.data;
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	$scope.getOrganizationByType = function(orgType, validated) {
		if(validated === true) {
			OrganizationService.fetchType(orgType)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.organizations = result.data.data;
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	$scope.getOrganizationByZip = function(orgZip, validated) {
		if(validated === true) {
			OrganizationService.fetchZip(orgZip)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.organizations = result.data.data;
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	//create new organization
	$scope.createOrganization = function(organization, validated) {
		if(validated === true) {
			OrganizationService.create(organization)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	//update the organization
	$scope.updateOrganization = function(organization, validated) {
		if(validated === true && $scope.isEditing === true) { //that scope.isEditing may change
			OrganizationService.update(organization.orgId, organization)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					});
		}
	};

	//delete the organization
	$scope.deleteOrganization = function(orgId) {
		//create a modal to ask for confirmation
		var message = "Do you really want to delete this organization?";
		var modalHtml = '<div class="modal-body">' + message + '</div><div class="modal-footer"><button class="btn btn-primary" ng-click="yes()">Yes</button><button class="btn btn-warning" ng-click-"no()">No</button></div>';
		var modalInstance = $uibModal.open({
			template: modalHtml,
			controller: ModalInstanceCtrl
		});

		//if yes is selected, delete the organization
		modalInstance.result.then(function() {
			OrganizationService.destroy(orgId)
					.then(function(result) {
						if(result.data.status === 200) {
							$scope.alerts[0] = {type: "success", msg: result.data.message};
						} else {
							$scope.alerts[0] = {type: "danger", msg: result.data.message};
						}
					})
		});
	};
}]);

//modal instance controller for deletion prompt
var ModalInstanceCtrl = function($scope, $uibModalInstance) {
	$scope.yes = function() {
		$uibModalInstance.close();
	};
	$scope.no = function() {
		$uibModalInstance.dismiss('cancel');
	};
};