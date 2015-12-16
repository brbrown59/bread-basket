//uses the sign-in service; doesn't use the sign in controller because of the modal
app.controller("ValidationController", ["$scope", "$uibModal", "$window", "AlertService", "SigninService", "VolunteerService", "GetCurrentService", function($scope, $uibModal, $window, AlertService, SigninService, VolunteerService, GetCurrentService) {

	$scope.volunteer = "";

	/**
	 * function allowing an admin who just validated their email to log-in
	 * @param signinData
	 * @param validation
	 */
	$scope.signin = function(signinData, validation) {
		if(validation === true) {
			SigninService.signin(signinData)
				.then(function(reply) {
					if(reply.status === 200) {
						AlertService.addAlert({type: "success", msg: reply.message});

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
										$window.location.assign("../../php/template/listing-nonadmin.php")
									}
								} else {
									$scope.alerts[0] = {type: "danger", msg: result.message};
								}
							});
					} else {
						AlertService.addAlert({type: "danger", msg: reply.message});
					}
				});
		}
	};
	/**
	 * function for allowing a new volunteer to set new passwords, and log them in
	 * @param newvolData
	 * @param validation
	 */
	$scope.setVolPasswords = function(newvolData, validation) {
		if(validation === true) {
			//get the volunteer in question
			VolunteerService.fetchEmail(newvolData.volEmail)
				.then(function(reply) {
						if(reply.status === 200) {
							//set the new volunteer passwords, and do an update
							$scope.volunteer = reply.data.data;
							$scope.volunteer.volPassword = newvolData.password;
							VolunteerService.update($scope.volunteer.volId, $scope.volunteer)
								.then(function(reply) {
									if(reply.status === 200) {
										//redirect them to the listing page
										//later, make this an if statement that checks if they're an admin
										AlertService.addAlert({type: "success", msg: reply.message});
										$window.location.assign("../../php/template/listing-nonadmin.php");
									} else {
										AlertService.addAlert({type: "danger", msg: reply.message});
									}
								})
						} else {
							AlertService.addAlert({type: "danger", msg: reply.message});
						}
					}
				)
		}
	};
}]);