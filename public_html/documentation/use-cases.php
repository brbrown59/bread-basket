<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>User Stories and Use Cases</title>
	</head>
	<body>
		<h2>User Stories</h2>
		<p>As a public user, I want to register for Bread Basket and create a profile.</p>
		<p>As a registered user, I want to put out a message that my grocery store has food available.</p>
		<p>As a registered user, I want to delete my earlier food listing.</p>
		<p>As a registered user, I want to respond to a reminder notification regarding my food listing.</p>
		<p>As a registered user, I want to get a report of my previous listings for tax purposes.</p>
		<p>As an administrator, I want to claim an available set of food for my food bank and inform my volunteers.</p>
		<p>As an administrator, I want to add a list of volunteer contacts to my food bank.</p>
		<p>As a registered user, I want to respond to a notification from a food bank and agree to pick up a claimed set of food.</p>
		<h2>Use Cases</h2>

		<h3>Use Case: Grocery store manager Alice wants to sign her store up for Bread Basket</h3>
		<ul>
			<li>Alice navigates to the home page of Bread Basket
			<li>Alice selects the registration option
			<li>The site sends Alice to a page containing a registration form
			<li>Alice selects the option to register as a food provider, instead of a food bank.
			<li>Alice enters the remaining pertinent information about her store
			<li>Alice confirms her information and presses a "Submit" button
			<li>The site takes Alice's information, creates an account, and sends Alice an e-mail to validate the new account</li>
			<li>Alice checks the validation e-mail and clicks the provided link</li>
			<li>The site validates the new account and logs Alice in</li>
		</ul>

		<h3>Use Case: Alice has available food, and wishes to notify the food banks</h3>
		<ul>
			<li>Alice goes to the Bread Basket home page and selects the "Log In" option.</li>
			<li>The site presents Alice with forms for her log-in information, which she fills out and submits</li>
			<li>The site logs Alice in.</li>
			<li>She sees her home page, which includes her contact information, her store's location/details and her recent listings</li>
			<li>She clicks a link to add a new listing</li>
			<li>A page is loaded that allows her to fill in the listing type, memo, pick up time, estimated cost</li>
			<li>Alice enters the pertinent information into the appropriate forms and clicks "Submit"</li>
			<li>The site takes the information and either confirms the new listing has been created, or displays an error message if it was not.</li>
		</ul>

		<h3>Use Case: Alice wants to check if her listing has been claimed</h3>
		<ul>
			<li>Alice opens her browser and logs in</li>
			<li>Her home page loads with her information and recent listings</li>
			<li>She clicks on her most recent listing and sees that it has just been claimed</li>
			<li>Alice closes her browser</li>
		</ul>

		<h3>Use Case: Alice gets a reminder to update her food donation status</h3>
		<ul>
			<li>Alice has posted a food listing earlier in the day but she's been busy managing issues at her store</li>
			<li>Alice looks at her phone and sees a message that says "Has your donation been picked up?"</li>
			<li>Her donation had been picked up, so Alice hits yes and is redirected to a thank you page</li>
			<li>OR Alice hits no and her posting is re-listed and sent to the relieving places</li>
			<li>Alice is relocated to a thank you page and she closes her browser.</li>
		</ul>

		<h3>Use Case: Alice wants to run a report for tax purposes</h3>
		<ul>
			<li>Alice opens her browser and logs into her account</li>
			<li>Her homepage loads and she sees her details, contact info, and recent listings</li>
			<li>She clicks a link called reporting and is brought to a page where she can run a report</li>
			<li>She selects a report that pulls all her successfully donated listing</li>
			<li>A table of data loads with her listings and their details</li>
			<li>She prints the pages for tax and or bragging purposes</li>
		</ul>

		<h3>Use Case: Julia wishes to add a list of volunteer contacts to her food bank.</h3>
		<ul>
			<li>Administrator opens app</li>
			<li>logs into app  by typing in password in the text field.</li>
			<li>Administrator opens the settings tab on top left corner of app</li>
			<li>the Settings tab opens and setting options are revealed.</li>
			<li>The Volunteer contact option is selected.</li>
			<li>A New page opens showing a list of volunteer names.</li>
			<li>At the bottom of the volunteer list, the "add new" button is selected.</li>
			<li>A new page opens in the app, a contact form field is displayed.</li>
			<li>The contact form is filled out with the new volunteers information (Name, Phone Number and Email)</li>
			<li>The save/submit volunteer button is pressed at the bottom of the form field.</li>
			<li>The App returns to list of volunteers, the newly added volunteer now appears on the list of volunteers.</li>
		</ul>

		<h3>Use Case: Julia is an administrator that wants to claim an available food donation for her food pantry, and then she wants to push a notification about claimed food to her volunteers.</h3>
		<ul>
			<li>Julia receives a push notification from the Bread Basket app.</li>
			<li>Registered user/volunteer receives a push notice their phone.</li>
			<li>She takes a look at the message that includes the location and what is being donated.</li>
			<li>Julia decides her food pantry can use the food and clicks the claim button.</li>
			<li>She is taken to the page that announces that she has claimed the food.</li>
			<li>She is then given the option to push a notice to her volunteers, and pushes the button to past the notification on to her volunteers</li>
			<li>Within 10 minutes Julia receives a notification that Joe will be picking up the donation.</li>
		</ul>

		<h3>Use Case: Joe receives a notification from his food bank about available food, and wants to go pick it up</h3>
		<ul>
			<li>Joe gets a push notification sent from the Bread Basket site about the available food on his phone</li>
			<li>The notification contains the information about the food and the pick up location, and a prompt to claim the food, and a link to the listing on the site</li>
			<li>Joe decides he can get the food, and clicks the "claim" option</li>
			<li>The site processes his claim</li>
		</ul>
	</body>
</html>