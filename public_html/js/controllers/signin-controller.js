app.controller("SigninController", ["$scope", "$uibModal", "$window", "AlertService", "SigninService", "GetCurrentService", function($scope, $uibModal, $window, AlertService, SigninService, GetCurrentService) {
	$scope.signinData = {};

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
				.then(function(reply) {
					if(reply.status === 200) {
						AlertService.addAlert({type: "success", msg: reply.message});
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
													} else if(result.data.data.orgType === "R") {
														//receiving admin
														$window.location.assign("../../php/template/login-landing-page.php")
													}
												} else {
													AlertService.addAlert({type: "danger", msg: reply.message});
												}
											});
									} else {
										//receiving volunteer
										$window.location.assign("../../php/template/listing-receive-view.php")
									}
								} else {
									AlertService.addAlert({type: "danger", msg: reply.message});
								}
							});

					} else {
						AlertService.addAlert({type: "danger", msg: reply.message});
					}
				});
		}, function() {
			$scope.signinData = {};
		});
	};
}]);