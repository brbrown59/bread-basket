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
		orgName: "Helping Bros out",
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

//variables to keep PHP state
var phpSession = undefined;
var xsrfToken = undefined;

//create a anew account to test with
var createAccount = function () {
	frisby.create("create new account")
		.post(signupURL, signupData, {json:true})
		.expectStatus(200)
		.expectJASON({
				status: 200,
				message: "logged in as administrator"
		})
		. toss();

};