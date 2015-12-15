/**
 * A service for sign-in
 *
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com>
 * contributing code from ng-abq @author Dylan McDonald
 */

//"signinService refers to what's in the signin-controller. 
app.service("SigninService", function($http){
	this.SIGNIN_ENDPOINT = "../../php/controllers/sign-in-controller.php";

	this.signin = function(signinData) { //signinData from the signin-controller and signin-modal
		return($http.post(this.SIGNIN_ENDPOINT, signinData)
				.then(function(reply) {
					return(reply.data);
				}));
	};
});

