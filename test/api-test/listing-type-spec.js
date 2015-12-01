// standard API variables
var frisby = require("frisby");
var endpointUrl = "https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype";
var signupUrl = "https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/controllers/sign-up-controller.php";

/**
 * Class Listing Type Unit Test.
 *
 * This is a test of the listing type class.
 * @author Tamra Fenstermaker <fenstermaker505@gmail.com> with contributing code by Dylan McDonald, Bradley Brown & Kimberly Keller
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
	orgName: "Enthusiastic Kitty",
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

//var listingTypeData = {
//	listingTypeId: null,
//	listingType: "perishable"
//}
//
//var listingTypeData2 = {
//	listingTypeId: null,
//	listingType: "nonperishable"
//}
//
//var listingTypeData3 = {
//	listingTypeId: null,
//	listingType: "refrigerated"
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
			.toss();
};

//// create a new listing type to test with
//var createListingType = function() {
//	frisby.create("create new listing type")
//			.post('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/', listingTypeData, {json: true})
//			.expectStatus(200)
//			.expectJSON({
//				status: 200,
//				message: "Listing type created OK"
//			})
//			.toss()
//};
//
//// create a second new listing type to test with
//var createListingType2 = function() {
//	frisby.create("create new listing type")
//			.post('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/', listingTypeData2, {json: true})
//			.expectStatus(200)
//			.expectJSON({
//				status: 200,
//				message: "Listing type created OK"
//			})
//			.toss()
//};
//
//// create a second new listing type to test with
//var createListingType3 = function() {
//	frisby.create("create new listing type")
//			.post('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/', listingTypeData3, {json: true})
//			.expectStatus(200)
//			.expectJSON({
//				status: 200,
//				message: "Listing type created OK"
//			})
//			.toss()
//};

//get listing type by id
var getListingTypeById = function () {
	frisby.create("get listing type by Id")
			.get('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/volunteer?email=fenstermaker505@gmail.com')
			.inspectJSON()
			.expectStatus(200)
			.expectJSON({
				status: 200
			})
			.toss();
};

////get all listTypes
//var getListingTypes = function () {
//	frisby.create("get all Listing Types")
//			.get('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingType')
//			.inspectJSON()
//			.expectStatus(200)
//			.expectJSON({
//				status: 200
//			})
//			.toss();
//};

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
			//getListingTypes();
			//updateAccount();
			//teardown();
			//createListingType();
			//createListingType2();
			//createListingType3();
		})
		.toss();

var teardown = function() {
	//sign out???

	//get the ID for the test organization, in order to delete it
	frisby.create("get volunteer to be deleted")
			.get('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/volunteer?email=fenstermaker505@gmail.com')
			.inspectJSON()//dumps json to console
			.afterJSON(function(json) {
				//based on examples from documentation, need to nest these
				frisby.create("delete volunteer")
						.delete('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/volunteer/' + json.data.volId)
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
			.get('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/organization?name=Enthusiastic Kitty')
			.afterJSON(function(json) {
				//based on examples from documentation, need to nest these
				frisby.create("delete organization")
						.delete('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/organization/' + json.data[0].orgId)
						.expectStatus(200)
						.expectJSON({
							status: 200,
							message: "Organization deleted OK"
						})
						.toss();
			})
			.toss();

	//get the ID for the test listing type, in order to delete it
	frisby.create("get listing type to be deleted")
			.get('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype?listingtype=perishable')
			.afterJSON(function(json) {
				//based on examples from documentation, need to nest these
				frisby.create("delete listing type")
						.delete('https://bootcamp-coders.cnm.edu/~tfenstermaker/bread-basket/public_html/php/api/listingtype/' + json.data.listingTypeIdId)
						.expectStatus(200)
						.expectJSON({
							status: 200,
							message: "Listing Type deleted OK"
						})
						.toss();
			})
			.toss();

	//sign out of the session
	frisby.create("sign out")
			.get('https:https://bootcamp-coders.cnm.edu/~tfenstermker/bread-basket/php/controllers/sign-out.php')
			.toss();
};

