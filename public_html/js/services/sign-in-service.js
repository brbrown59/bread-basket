/**
 * A service for sign-in
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributing code from ng-abq @author Dylan McDonald
 */

//"signinService refers to what's in the signin-controller. Todo add Sign in Service to js SignIn Controller TODO is this the correct endpoint?
app.service("SigninService", function($http){
	this.SIGNIN_ENDPOINT = "../../php/api/controllers/sign-in-controller.php";

	this.signin = function(signinData) { //signinData from the signin-controller and signin-modal
		return($http.post(this.SIGNIN_ENDPOINT, signinData)
				.then(function(reply) {
					return(reply.data);
				}));
	};
});

