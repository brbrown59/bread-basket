<div class="modal-body" xmlns="http://www.w3.org/1999/html">
	<form id="contactForm" name="contactForm">
		<h3>Contact Us</h3>
		<hr/>
		<!--begin contact us fields-->
		<!--first name-->
		<label class="control-label" for="firstname">Name</label>
		<div class="form-inline form-group-lg" ng-class="{ 'has-error' : contactForm.firstname.$touched && contactForm.firstname.$invalid }">
			<label class="control-label sr-only" for="firstname">Name</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" ng-model="contactData.firstname" ng-required="true">
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="contactForm.firstname.$error" ng-if="contactForm.firstname.$touched" ng-hide="contactForm.firstname.$valid">
				<p ng-message="required">Please enter a first name</p>
			</div>
			<!--last name-->
			<label class="control-label sr-only" for="lastname">Last Name</label>
			<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" ng-model="contactData.lastname" ng-required="true">
			<div class="alert alert-danger" role="alert" ng-messages="contactForm.lastname.$error" ng-if="contactForm.lastname.$touched" ng-hide="contactForm.lastname.$valid">
				<p ng-message="required">Please enter a last name</p>
			</div>
		</div>
		<!--contact info-->
		<label class="control-label" for="firstname">Contact</label>
		<div class="form-inline form-group-lg" ng-class="{ 'has-error': contactForm.email.$touched && contactForm.email.$invalid }">
			<!--email-->
			<label class="control-label sr-only" for="email">Email</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				</div>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email" ng-model="contactData.email" ng-required="true" />
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="contactForm.email.$error" ng-if="contactForm.email.$touched" ng-hide="contactForm.email.$valid">
				<p ng-message="email">Email is invalid.</p>
				<p ng-message="required">Please enter an email.</p>
			</div>
			<!--phone-->
			<label class="control-label sr-only " for="phone">Phone</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" ng-model="contactData.phone" ng-required="true" />
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="contactForm.phone.$error" ng-if="contactForm.phone.$touched" ng-hide="contactForm.phone.$valid">
				<p ng-message="required">Please enter a phone number.</p>
			</div>
		</div>

		<!--subject-->
		<div class="form-group-lg" ng-class="{ 'has-error' : contactForm.subject.$touched && contactForm.subject.$invalid }">
			<label class="control-label" for="subject">Subject</label>
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
					</div>
				<input type="text" class="form-control" maxlength = "256" id="subject" name="subject" placeholder="Subject" ng-model="contactData.subject" ng-maxlength="256" ng-required="true">
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="contactForm.subject.$error" ng-if="contactForm.subject.$touched" ng-hide="contactForm.subject.$valid">
				<p ng-message="required">Please enter a subject</p>
				<p ng-message="maxlength">Subject is too long.</p>
			</div>
		</div>

		<!--message-->
		<div class="form-group-lg" ng-class="{ 'has-error' : contactForm.message.$touched && contactForm.message.$invalid }">
			<label class="control-label" for="message">Message</label>
			<textarea class="form-control" rows ="3" maxlength = "1024" id="message" name="message" placeholder="How can we help?" ng-model="contactData.message" ng-maxlength="1024" ng-required="true"></textarea>
			<div class="alert alert-danger" role="alert" ng-messages="contactForm.message.$error" ng-if="contactForm.message.$touched" ng-hide="contactForm.message.$valid">
				<p ng-message="required">Please enter a message</p>
				<p ng-message="maxlength">Message is too long.</p>
			</div>
		</div>
		<button type="submit" class="btn btn-primary" ng-click="ok();" ng-disabled="contactForm.$invalid"><i class="fa fa-check" aria-hidden="true"></i>Submit</button>
		<button type="reset" class="btn btn-warning" ng-click="cancel();"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
	</form>
</div>