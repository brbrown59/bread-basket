/**
 * A service for sign-in
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributing code from ng-abq @author Dylan McDonald
 */

//"signinService refers to what's in the signin-controller. Todo add Sign in Service to js SignIn Controller TODO is this the correct endpoint?
app.service("SigninService", function($http){
	this.SIGNUP_ENDPOINT = "";

	this.signin = function(signinData) { //signinData from the signin-controller and signin-modal
		return($http.post(this.SIGNUP_ENDPOINT, signinData)
				.then(function(reply) {
					return(reply.data);
				}));
	};
});

