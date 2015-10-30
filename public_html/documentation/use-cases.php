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
		<p>As a registered user, I want to delete my earlier food listing.Kimberly</p>
		<p>As a registered user, I want to respond to a reminder notification regarding my food listing.Kimberly</p>
		<p>As an administrator, I want to claim an available set of food for my food bank.Tamra</p>
		<p>As an administrator, I want to push a notification about claimed food to my volunteers.Tamra</p>
		<p>As an administrator, I want to add a list of volunteer contacts to my food bank.Carlos</p>
		<p>As a registered user, I want to respond to a notification from a food bank and agree to pick up a claimed set of food.Tamra</p>
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
			<li>The site presents Alice with forms for her log-in information</li>
			<li>Alice enters her log-in credentials and presses the "Submit" button.</li>
			<li>The site logs Alice in.</li>
			<li>Alice navigates to a "Create New Listing" option.</li>
			<li>The site presents Alice with two forms: one for a description of the available food, another for the monetary value of said food</li>
			<li>Alice enters the pertinent information into the appropriate forms and clicks "Submit"</li>
			<li>The site takes the information and either confirms the new listing has been created, or displays an error message if it was not.</li>
		</ul>

		<h3>Administrator-foodbank, I want to add a list of volunteer contacts to my food bank.Carlos</h3>
		<ul>
			<li>Administrator opens app</li>
			<li>logs into app  by typing in password in the text field.</li>
			<li>Administrator directs them selves to the settings tab on top left corner of app</li>
			<li>the Settings tab opens and setting options are revealed.</li>
			<li>The Volunteer contact option is selected.</li>
			<li>A New page opens showing a list of volunteer names.</li>
			<li>At the bottom of the volunteer list, the "add new? button is selected.</li>
			<li>A new page opens in the app, a contact form field is displayed.</li>
			<li>The contact form is filled out with the new volunteers information (Name, PH# & Email)</li>
			<li>The save/submit volunteer button is pressed at the bottom of the form field.</li>
			<li>The App returns to list of volunteers, the newly added volunteer now appears on the list of volunteers.</li>
		</ul>

		<h3>As a registered user-julia, I want to respond to a notification from a food bank and agree to pick up a claimed set of food.Carlos</h3>
		<ul>
			<li>Registered user/volunteer receives a push notice their phone.</li>
			<li>Volunteer opens app</li>
			<li>app opens and a alerted to a pending request flashes on phone.</li>
			<li>user clicks alert and new page opens with additional info regarding clicked alert.</li>
			<li>user reads alert and then clicks “commit button? and confirms to pick-up and deliver food items.</li>
		</ul>

		<h3>As a registered user, I want to respond to a reminder notification regarding my food listing.</h3>
		<ul>

			<p>Julia, is an administrator that wants to claim an available set of food for her food bank, and then she wants to push a notification about claimed food to her volunteers.</p>
			<ul>
				<li>Julia receives a push notification from the Bread Basket app.</li>
				<li>Registered user/volunteer receives a push notice their phone.</li>
				<li>She takes a look at the message that includes the location and what is being donated.</li>
				<li>Julia decides her food pantry can use the food and clicks the claim button.</li>
				<li>She is taken to the page that announces that she has claimed the food.</li>
				<li>She is then given the option to push a notice to her volunteers, and pushes the button to past the notification on to her volunteers</li>
				<li>Within 10 minutes Julia receives a notification that Joe will be picking up the donation,.</li>
			</ul>
		</ul>
	</body>
</html>