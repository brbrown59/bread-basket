// standard API variables
var frisby = require("frisby");
var endpointUrl = "https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer/";
var signupUrl = "https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/controllers/sign-up-controller.php";

// user creation variables
var signupData = {
	orgAddress1: "4209 Brockmont NE",
	orgAddress2: null,
	orgCity: "Albuquerque",
	orgDescription: "Petting Kitties All Day",
	orgHours: "It's always nap time",
	orgName: "Happy Kitty",
	orgPhone: "8675309",
	orgState: "NM",
	orgType: "G",
	orgZip: "87102",
	volEmail: "kimberly@gravitaspublications.com",
	volFirstName: "Senator",
	volLastName: "Arlo",
	volPassword: "p@ssword",
	volPhone: "5053041090"
}

var updateData = {
	volEmail: "kimberly@gravitaspublications.com",
	volFirstName: "Renly",
	volLastName: "Arlo",
	volPassword: "p@ssword",
	volPhone: "5053041090"
}


//variables for dependencies

var volId;
var orgId;


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
			.toss();
};
// update the volunteer with new information
var updateAccount = function() {
	frisby.create("get volunteer to be edited")
			.get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer?email=kimberly@gravitaspublications.com')
			//.inspectJSON()

					.afterJSON(function(json) {
						updateData.orgId = json.data.orgId
						frisby.create("update volunteer")
								.put('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer/' + json.data.volId, updateData, {json: true})
								//.inspectJSON()
								.expectStatus(200)
								.expectJSON({
									status: 200,
									message: "Volunteer updated OK"
								})
								.after(function(body, response) {
									frisby.create("grab updated volunteer")
											.get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer/?email=kimberly@gravitaspublications.com')
											//.inspectJSON()
											.expectStatus(200)
											.expectJSON({
												status: 200
											})
											.toss();

								})
								.toss();
					})
					.toss();

};

//get volunteer by fields


//get volunteer by email provided
var getVolByEmail = function () {
	frisby.create("get volunteer by email")
			.get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer?email=kimberly@gravitaspublications.com')
			.inspectJSON()
			.expectStatus(200)
			.expectJSON({
				status: 200
			})
			.toss();
};

//get volunteer by phone number
var getVolByPhone = function () {
	frisby.create("get volunteer by phone number")
			.get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer?phone=5053041090')
			.inspectJSON()
			.expectStatus(200)
			.expectJSON({
				status: 200
			})
			.toss();
};

//get volunteer by admin
var getVolByAdmin = function () {
	frisby.create("get volunteer by admin")
			.get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer?isAdmin=1')
			.inspectJSON()
			.expectStatus(200)
			.expectJSON({
				status: 200
			})
			.toss();
};

//get all volunteers
var getAllVol = function () {
	frisby.create("get all volunteers")
			.get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer')
			.inspectJSON()
			.expectStatus(200)
			.expectJSON({
				status: 200
			})
			.toss();
};



var teardown = function() {
	//sign out???

	//get the ID for the test organization, in order to delete it
	frisby.create("get volunteer to be deleted")
			.get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/volunteer?email=kimberly@gravitaspublications.com')
			//.inspectJSON()//dumps json to console
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

	//get the ID for the test organization, in order to delete it
	frisby.create("get organization to be deleted")
			.get('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/organization?name=Happy Kitty')
			.afterJSON(function(json) {
				//based on examples from documentation, need to nest these
				frisby.create("delete organization")
						.delete('https://bootcamp-coders.cnm.edu/~kkeller13/bread-basket/public_html/php/api/organization/' + json.data[0].orgId)
						.expectStatus(200)
						.expectJSON({
							status: 200,
							message: "Organization deleted OK"
						})
						.toss();
			})
			.toss();

	//sign out of the session
	frisby.create("sign out")
			.get('https:https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/php/controllers/sign-out.php')
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
			updateAccount();
			getVolByEmail();
			getVolByPhone();
			getAllVol();
			getVolByAdmin();
			teardown();
		})
		.toss();