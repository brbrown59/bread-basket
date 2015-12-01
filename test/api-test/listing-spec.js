// standard API variables
var frisby = require("frisby");
var endpointUrl = "https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/listing";
var signupUrl = "https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/controllers/sign-up-controller.php";

// user creation variables
var signupData = {
	orgAddress1: "123 Easy Street NW",
	orgAddress2: null,
	orgCity: "Albuquerque",
	orgDescription: "Feeding Kitties since 1968",
	orgHours: "9 hours per day, minus naps",
	orgName: "Feed the Kitty",
	orgPhone: "+15055551212",
	orgState: "NM",
	orgType: "G",
	orgZip: "87102",
	volEmail: "breadbasketapp@gmail.com",
	volFirstName: "Senator",
	volLastName: "Arlo",
	volPassword: "p@ssword",
	volPhone: "+15055551212"
}

//variables related to dependencies and test fields
var listingTypeData = {
	listingType: "Perishable"
}

var volId;

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

// insert the dependencies into the database, and ensure their existence
/*
var setup = function() {
	frisby.create("create new listing type")
			.post("https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/listingtype", listingTypeData, {json: true})
			.expectStatus(200)
			.expectJSON({
				status: 200,
				message: "Listing Type created OK"
			});
			.get("https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/listingtype?'listingType'='Perishable'")
			.after(function (body, response) {
					//get the id from the body
					body = JSON.parse(body);
					listingTypeId = body.ListingTypeId; //make sure this is getting what I think it does
				})
			.toss();
};*/

var teardown = function() {
	//sign out???

	//get the ID for the test organization, in order to delete it
	frisby.create("get volunteer to be deleted")
			.get('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/volunteer?email=breadbasketapp@gmail.com')
			.inspectJSON()
			.afterJSON(function(json) {
				//based on examples from documentation, need to nest these
				frisby.create("delete volunteer")
						.delete('https://bootcamp-coders.cnm.edu/~bbrown52/bread-basket/public_html/php/api/volunteer/1')
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
		/*
		setup(); // insert dependencies into database, probably include just beneath xsrf stuff
					// log-in SHOULD create an organization and a volunteer for us
		//basic form: take json of dependency, post request, get request on another unique but predictable field, get and store ID
		validPost();
		invalidPost();
		validGetAll();
		validGetByFoo(); //get by something else is going to have to come above get by id
		validPut();
		invalidPut();
		invalidGet;
		validDelete();
		invalidDelete();
		teardown(); //delete dependencies from database DO THIS NOW FOR THE OTHER STUFF
		 */
	})
	.toss();
