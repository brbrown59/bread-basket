// standard API variables
var frisby = require("frisby");
var endpointUrl = "https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/message";
var signupURL = "https://bootcamp-coders.cnm.edu/~cberaun2/brad-basket/public_html/php/controllers/sign-up-controller.php";

//user creation variables
var signupData = {
		orgAddress1: "722 lomas",
		orgAddress2: null,
		orgCity: "Los Lunas",
		orgDescription: "helping homies do right",
		orgHours: "24 hrs a day",
		orgName: "Helping Bros stay out",
		orgPhone: "+15057729283",
		orgState: "NM",
		orgType: "G",
		orgZip: "87120",
		volEmail: "cbabq505@gmail.com",
		volFirstName: "Vato",
		volLastName: "Loco",
		volPassword: "iknowright",
		volPhone: "+15052554186"
}


var updateData = {
	listingClaimedBy: "Helping bros out",
	listingCost: "10",
	listingMemo: "good for sauce",
	listingTypeId: "perishable",
}


//variables for dependencies
var listingId;
var orgId;

//variables to keep PHP state
var phpSession = undefined;
var xsrfToken = undefined;

//create a new account to test with
var createAccount = function () {
	frisby.create("create new account")
		.post(signupURL, signupData, {json:true})
		.expectStatus(200)
		.expectJSON({
				status: 200,
				message: "logged in as administrator"
		})
		. toss();

};

var updateAccount = function() {
	frisby.create("get message to be edited")
		.get('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/message?email=cbabq505@gmail.com')
		.inspectJSON()
		.afterJSON(function (json) {
				updateData.orgid = json.data.orgid
				frisby.create("update message")
					.put('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/message/' + jason.data.listingId, updateData,{json:true} )
					.inspectJSON()
					.expectStatus(200)
					.expectJSON({
							status: 200,
							message: "Message Updated ok"
					})
					.after(function(body, response) {
						frisby.create("grab updated message")
							.get('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/message?email=cbabq505@gmail.com')
						//.inspectJSON()
							.expectStatus(200)
							.expectJSON({
								status:200
							})
							.toss();
					})

					.toss();
		})
		.toss();
		};



var teardown = function() {

	//get the Id for the test organization, in order to dwlwt it
	frisby.create("get message to be deleted")
		.get('http').get('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/message?email=cbabq505@gmail.com')
		//.inspect () //dump json ot console
		.afterJSON(function(json) {
			//based on examples from documentation, need to nest these
			frisby.create("delete message ok")
				.expectStatus(200)
				.expectJSON({
					status: 200,
					message: "Message Delete ok"
				})
				.toss();
		})
		.toss();

	//get the ID for the test organization, in order to delete it
	frisby.create("get organization to be deleted")
		.get('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/organization?name=Helping Bros stay out')
		.afterJSON(function(json) {
			//based on examples from documentation, need to nest these
			frisby.create("delete message")
				.delete('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/public_html/php/api/message/' + json.data.messageId)
				.expectStatus(200)
				.expectJSON({
					status: 200,
					message: "Message deleted OK"
				})
				.toss();
		})
		.toss();

	//sign out of the session
	frisby.create("sign out")
		.get('https://bootcamp-coders.cnm.edu/~cberaun2/bread-basket/php/controllers/sign-out.php')
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
