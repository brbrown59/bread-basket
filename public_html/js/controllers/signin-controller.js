app.controller("SigninController", ["$scope", "$uibModal", function($scope, $uibModal) {
	$scope.signinData = {};

	$scope.openSigninModal = function () {
		var signupModalInstance = $uibModal.open({
			templateUrl: "../../js/views/signin-modal.php",
			controller: "SigninModal",
			resolve: {
				signinData : function () {
					return($scope.signinData);
				}
			}
		});
	}
}]);