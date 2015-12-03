app.controller("SignupController", ["$scope", "$uibModal", "SignupService", function($scope, $uibModal, SignupService) {
	$scope.signinData = {};

	$scope.openSignupModal = function () {
		var signupModalInstance = $uibModal.open({
			templateUrl: "../../js/views/signup-modal.php",
			controller: "SignupModal",
			resolve: {
				signinData : function () {
					return($scope.signinData);
				}
			}
		});
	}
}]);