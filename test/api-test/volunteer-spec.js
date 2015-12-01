// standard API variables
var frisby = require("frisby");
var endpointUrl = "https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer";
var signupUrl = "https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/controllers/sign-up-controller.php";


// user creation variables
var signupData = {
	orgAddress1: "401 Copper Ave NW",
	orgAddress2: null,
	orgCity: "Albuquerque",
	orgDescription: "Feeding Kitties since 1968",
	orgHours: "9 hours per day, minus naps",
	orgName: "Feed All the Kitties",
	orgPhone: "+15055551212",
	orgState: "NM",
	orgType: "G",
	orgZip: "87102",
	volEmail: "kimberly@gravitaspublications.com",
	volFirstName: "Senator",
	volLastName: "Arlo",
	volPassword: "p@ssword",
	volPhone: "+15055551212"
}

var volId;

//var updateData = {
//	volPhone: "5053334567"
//}
//
//var login = {
//	email: "kimberly@gravitaspublications.com",
//	password: "p@ssword"
//}


// variables to keep PHP state
var phpSession = undefined;
var xsrfToken = undefined;

// create a new account to test with
var createAccount = function() {
	frisby.create("create new account")
		.post(signupUrl, signupData, {json: true})
		.expectStatus(200)
		.expectJSON({
			status: 200,
			message: "Logged in as administrator"
		})
		.inspectJSON()
		.toss();
};

//var updateAccount = function() {
//	frisby.create("update an account")
//		.put(signupUrl, login, getByVolId(), endpointUrl, updateData, {json: true})
//		.expectStatus(200)
//		.expectJSON({
//			status: 200,
//			message: "Volunteer updated OK"
//		})
//		.inspectJSON()
//		.toss();
//};
//
//var getByVolId = function() {
//	frisby.create("get volunteer by id")
//			.get(endpointUrl + '/index.php?id=64')
//			.expectStatus(200)
//			.expectJSON({
//				status: 200,
//				message: "volunteer by vol id"})
//			.inspectJSON()
//			.toss();
//};
  

//var getByOrgId = function() {
//
//  }  ;
//
//var getByEmail = function() {
//
//  };  
//
//var getByIsAdmin = function() {
//
//  };
//
//  var getByEmailActivation = function() {
//
//};
//
//  var getbyInvalid = function() {  
//
//};
//
//var deleteAccount = function() {
//	frisby.create("delete an account")
//			.delete(getByVolId(), endpointUrl)
//			.expectStatus(200)
//			.expectJSON({
//				status: 200,
//				message:"Volunteer deleted OK"
//			})
//			.inspectJSON()
//			.toss();
//};

var teardown = function() {
	//sign out???

	//get the ID for the test organization, in order to delete it
	frisby.create("get volunteer to be deleted")
			.get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer?email=kimberly@gravitaspublications.com')
			.inspectJSON()//dumps json to console
			.afterJSON(function(json) {
				//based on examples from documentation, need to nest these
				frisby.create("delete volunteer")
						.delete('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer/' + json.data.volId)
						.expectStatus(200)
						.expectJSON({
							status: 200,
							message: "Volunteer deleted OK"
						})
						.toss();
			})
			.toss();
};


// first, get the XSRF token
frisby.create("GET XSRF Token")
	.get(endpointUrl)
	.expectStatus(200)
	.after(function (body, response) {
		var phpParser = /^PHPSESSID=([a-z0-9]{26})/;
		var xsrfParser = /^XSRF-TOKEN=([\da-f]{128})/;
		response.headers["set-cookie"].forEach(function(cookie) {
			if(xsrfToken === undefined && cookie.match(xsrfParser) !== null) {
				xsrfToken = cookie.match(xsrfParser)[1];
			}
			if(phpSession === undefined && cookie.match(phpParser) !== null) {
				phpSession = cookie.match(phpParser)[1];
			}
		});
		// ensure the PHP session & XSRF token was defined before proceeding
		expect(phpSession).toBeDefined();
		expect(xsrfToken).toBeDefined();
		// now, setup the PHP session & XSRF token
		frisby.globalSetup({
			request: {
				headers: {
					"Content-Type": "application/json",
					Cookie: "PHPSESSID=" + phpSession + "; path=/",
					"X-XSRF-TOKEN": xsrfToken}
			}
		});
		createAccount();
		teardown();
		//getByVolId();
		//updateAccount();
		//deleteAccount();
	})
	.toss();