app.controller("SigninController", ["$scope", "$uibModal", "$window", "AlertService", "SigninService", "GetCurrentService", function($scope, $uibModal, $window, AlertService, SigninService, GetCurrentService) {
	$scope.signinData = {};
	$scope.alerts = [];

	$scope.openSigninModal = function() {
		var signinModalInstance = $uibModal.open({
			templateUrl: "../../js/views/signin-modal.php",
			controller: "SigninModal",
			resolve: {
				signinData: function() {
					return ($scope.signinData);
				}
			}
		});
		signinModalInstance.result.then(function(signinData) {
			$scope.signinData = signinData;
			SigninService.signin(signinData)
				.then(function(result) {
					if(result.status === 200) {
						console.log(result);
						$scope.alerts[0] = {type: "success", msg: result.message};
						//three potential cases here: receiving volunteer, receiving admin, giving admin
						//Receiving volunteer redirects to the listing page, the other two go to their respective landing pages
						GetCurrentService.fetchVolCurrent()
							.then(function(result) {
								if(result.data.status === 200) {
									if(result.data.data.volIsAdmin === true) {
										GetCurrentService.fetchOrgCurrent()
											.then(function(result) {
												if(result.data.status === 200) {
													if(result.data.data.orgType === "G") {
														//giving admin
														$window.location.assign("../../php/template/login-landing-giver.php")
													} else if(result.data.data.orgType === "R") {
														//receiving admin
														$window.location.assign("../../php/template/login-landing-page.php")
													}
												} else {
													$scope.alerts[0] = {type: "danger", msg: result.message};
												}
											});
									} else {
										//receiving volunteer
										$window.location.assign("../../php/template/listing-receive-view.php")
									}
								} else {
									$scope.alerts[0] = {type: "danger", msg: result.message};
								}
							});

					} else {
						$scope.alerts[0] = {type: "danger", msg: result.message};
					}
				});
		}, function() {
			$scope.signinData = {};
		});
	};
}]);