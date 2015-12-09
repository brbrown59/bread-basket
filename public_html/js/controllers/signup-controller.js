
app.controller("SignupController", ["$scope", "$uibModal", "$window", "AlertService", "SignupService", function($scope, $uibModal, $window, AlertService, SignupService) {
	$scope.signupData = {};

	$scope.openSignupModal = function () {
		var signupModalInstance = $uibModal.open({
			templateUrl: "../../js/views/signup-modal.php",
			controller: "SignupModal",
			resolve: {
				signupData: function () {
					return($scope.signupData);
				}
			}
		});
		signupModalInstance.result.then(function (signupData) {
			$scope.signupData = signupData;
			SignupService.signup(signupData)
					.then(function(reply) {
						if(reply.status === 200) {
							AlertService.addAlert({type: "success", msg: reply.message});
							$window.location.assign("../../php/template/login-landing-page.php");
						} else {
							AlertService.addAlert({type: "danger", msg: reply.message});
						}
					});
		}, function() {
			$scope.signupData = {};
		});
	};
}]);