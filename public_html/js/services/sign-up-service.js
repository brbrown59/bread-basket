/**
 * A service for sign-up
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributing code from ng-abq @author Dylan McDonald
 */

//"signupService refers to what's in the signup-controller.
app.service("SignupService", function($http) {
	this.SIGNUP_ENDPOINT = "../../php/controllers/sign-up-controller.php";//this is the php sign-up-controller

	this.signup = function(signupData) { //signupData from the signup-controller and signup-modal
		//console.log("I am Arlo!")
		console.log(signupData);
		return ($http.post(this.SIGNUP_ENDPOINT, signupData)
			.then(function(reply) {
				//console.log("I am a Dylan!")
				console.log(reply.data);
				return (reply.data);
			}));
	};
});

