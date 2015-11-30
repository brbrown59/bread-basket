// standard API variables
var frisby = require("frisby");
var endpointUrl = "https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype";
var signupUrl = "https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/controllers/sign-up-controller.php";

/**
 * Class Listing Type Unit Test.
 *
 * This is a test of the listing type class.
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com> with contributing code by Dylan McDonald
 *
 *
 * @see ListingType
 */

// user creation variables
var signupData = {
	orgAddress1: "401 Copper Ave NW",
	orgAddress2: null,
	orgCity: "Albuquerque",
	orgDescription: "Feeding Kitties since 1968",
	orgHours: "9 hours per day, minus naps",
	orgName: "Feed the Kitty",
	orgPhone: "+15055551212",
	orgState: "NM",
	orgType: "G",
	orgZip: "87102",
	volEmail: "fenstermaker505@gmail.com",
	volFirstName: "Senator",
	volLastName: "Arlo",
	volPassword: "p@ssword",
	volPhone: "+15055551212"
}

//Listing type variables
var listingTypeData = {
	listingTypeInfo: "Refrigerated",
}

//Listing type variable 2
var listingTypeData2 = {
	listingTypeInfo2: "Perishable",
}


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

// testValidCreate() I'm not sure this needs to be tested but they need to be created to pull
// test getting by para meter new listing type
// create a new listing type, and insert into database
var createListingType = function() {
	frisby.create("create new listing type")
			.post(null, listingTypeData, {json: true})
			.expectStatus(200)//nothing written into code
			.expectJSON({
				status: 200,
				message: "Logged in as administrator"
			})
			.toss();
};

// testValidGet()
// test getting by para meter new listing type
// create a new listing type, and insert into database
var testValidGet = function() {
	frisby.create("create new listing type")
			.post(null, listingTypeData, {json: true})
			.expectStatus(200)//nothing written into code
			.expectJSON({
				status: 200,
				message: "Logged in as administrator"
			})
			.toss();
};

// testValidGetAll()
// test getting by para meter new listing type
// create a new listing type, and insert into database
var testValidGetAll = function() {
	frisby.create("create new listing type")
			.post(null, listingTypeData, {json: true})
			.expectStatus(200)//nothing written into code
			.expectJSON({
				status: 200,
				message: "Logged in as administrator"
			})
			.toss();
};

// testInvalidGet()
// test getting by para meter new listing type
// create a new listing type, and insert into database
var testInvalidGet = function() {
	frisby.create("create new listing type")
			.post(null, listingTypeData, {json: true})
			.expectStatus(200)//nothing written into code
			.expectJSON({
				status: 200,
				message: "Logged in as administrator"
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
	})
	.toss();