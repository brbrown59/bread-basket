/**
 * A service for sign-up
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributing code from ng-abq @author Dylan McDonald
 */

//"signupService refers to what's in the signup-controller. Todo add Sign up Service to js Signup Controller TODO is this the correct endpoint?
app.service("SignupService", function($http){
	this.SIGNUP_ENDPOINT = "../php/api/controllers/sign-up-controller.php";//this is the php sign-up-controller

	this.signup = function(signupData) { //signupData from the signup-controller and signup-modal
		return($http.post(this.SIGNUP_ENDPOINT, signupData)
			.then(function(reply) {
				return(reply.data);
			}));
	};
});

