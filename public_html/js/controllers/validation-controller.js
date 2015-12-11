//uses the sign-in service; doesn't use the sign in controller because of the modal
app.controller("ValidationController", ["$scope", "$uibModal", "$window", "AlertService", "SigninService", "VolunteerService", function($scope, $uibModal, $window, AlertService, SigninService, VolunteerService) {

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
						$window.location.assign("../../php/template/login-landing-page.php");
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
			console.log(newvolData.volEmail);
			VolunteerService.fetchEmail(newvolData.volEmail)
				.then(function(reply) {
					if(reply.status === 200) {
						//set the new volunteer passwords, and do an update
						console.log(reply.data);
						$scope.volunteer = reply.data.data;
						$scope.volunteer.volPassword = newvolData.password;
						VolunteerService.update($scope.volunteer.volId, $scope.volunteer)
							.then(function(reply) {
								if(reply.status === 200) {
									//sign the volunteer into the program
									SigninService.signin(newvolData) //sends the validation, but api should ignore it
										.then(function(reply) {
											if(reply.status === 200) {
												//redirect them to the listing page
												//later, make this an if statement that checks if they're an admin
												AlertService.addAlert({type: "success", msg: reply.message});
												$window.location.assign("../../php/template/listing-receive-view.php");
											} else {
												AlertService.addAlert({type: "danger", msg: reply.message});
											}
										})
								} else {
									AlertService.addAlert({type: "danger", msg: reply.message});
								}
							})
					} else {
						AlertService.addAlert({type: "danger", msg: reply.message});
					}
				})
		}
	};
}]);