app.controller("SignupController", ["$scope", "$uibModal", function($scope, $uibModal) {
	$scope.signinData = {};

	$scope.openSignupModal = function () {
		var signupModalInstance = $uibModal.open({
			templateUrl: "/js/views/signup-modal.php",
			controller: "SignupModal",
			resolve: {
				signinData : function () {
					return($scope.signinData);
				}
			}
		});
	}
}]);