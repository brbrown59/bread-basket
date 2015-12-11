//uses the sign-in service; doesn't use the sign in controller because of the modal
app.controller("ValidationController", ["$scope", "$uibModal", "$window", "AlertService", "SigninService", function($scope, $uibModal, $window, AlertService, SigninService) {

	$scope.signin = function(signinData, validation) {
		if(validation === true) {
			SigninService.signin(signinData)
					.then(function(reply) {
						if(reply.status === 200) {
							AlertService.addAlert({type: "success", msg: reply.message});
							$window.location.assign("../../php/template/login-landing-page.php")
						} else {
							AlertService.addAlert({type: "danger", msg: reply.message});
						}
					});
		}
	}
	}]);