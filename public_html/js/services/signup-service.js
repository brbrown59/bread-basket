app.service("SignupService", function($http) {
	this.SIGNUP_ENDPOINT = "/auth/signup";

	this.signup = function(signupData) {
		return($http.post(this.SIGNUP_ENDPOINT, signinData)
			.then(function(reply) {
				return(reply.data);
			}));
	};
});