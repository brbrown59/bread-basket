<div class="modal-header">
	<h2>Join Us!</h2>
</div>

<div class="modal-body">
	<form id="signupForm" name="signupForm">
		<!--first name-->
		<div class="form-group" ng-class="{ 'has-error' : signupForm.volFirstName.$touched && signupForm.volFirstName.$invalid }">
		<h5>
			<label class="control-label" for="name">Name</label>
		</h5>

			<label class="control-label sr-only" for="volFirstName">First Name</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="volFirstName" name="volFirstName" placeholder="First Name"
						 ng-model="signupData.volFirstName" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.volFirstName.$error"
				  ng-if="signupForm.volFirstName.$touched" ng-hide="signupForm.volFirstName.$valid">
				<p ng-message="required">Please enter your first name</p>
			</div>
		</div>

		<div class="form-group" ng-class="{ 'has-error' : signupForm.volLasttName.$touched && signupForm.volLasttName.$invalid }">
			<!--last name-->
			<label class="control-label sr-only" for="volLastName">Last Name</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="volLastName" name="volLastName" placeholder="Last Name"
						 ng-model="signupData.volLastName" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.volLastName.$error"
				  ng-if="signupForm.volLastName.$touched" ng-hide="signupForm.volLastName.$valid">
				<p ng-message="required">Please enter your last name</p>
			</div>
		</div>



		<!--email-->
		<div class="form-group" ng-class="{ 'has-error': signupForm.volEmail.$touched && signupForm.volEmail.$invalid }">
			<h5>
			<label class="control-label" for="volEmail">Email</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				</div>
				<input type="email" class="form-control" id="volEmail" name="volEmail" placeholder="Email"
						 ng-model="signupData.volEmail" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert"
				  ng-messages="signupForm.volEmail.$error"
				  ng-if="signupForm.volEmail.$touched"
				  ng-hide="signupForm.volEmail.$valid">
				<p ng-message="email"> Email is invalid.</p>
				<p ng-message="required">Please enter your email.</p>
			</div>
		</div>

		<!--phone number-->
		<div class="form-group" ng-class="{ 'has-error': signupForm.volPhone.$touched && signupForm.volPhone.$invalid }">
			<h5>
			<label class="control-label" for="phone">Phone</label>
			</h5>

			<div class="input-group">

				<div class="input-group-addon">
					<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="volPhone" name="volPhone" placeholder="Phone"
						 ng-model="signupData.volPhone" ng-required="true" ng-minlength="10" ng-maxlength="25"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.volPhone.$error"
				  ng-if="signupForm.volPhone.$touched" ng-hide="signupForm.volPhone.$valid">
				<p ng-message="required">Please enter your phone number.</p>
				<p ng-message="minlength">Phone too short.</p>
				<p ng-message="maxlength">Phone too long.</p>
			</div>
		</div>

		<!--password-->
		<div class="form-group" ng-class="{ 'has-error': signupForm.password.$touched && signupForm.password.$invalid }">
			<h5>
			<label class="control-label" for="password">Password</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-key" aria-hidden="true"></i>
				</div>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password&hellip;"
						 ng-model="signupData.password" ng-minlength="8" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.password.$error"
				  ng-if="signupForm.password.$touched" ng-hide="signupForm.password.$valid">
				<p ng-message="minlength">Password must be at least 8 characters.</p>
				<p ng-message="required">Please enter your password.</p>
			</div>
		</div>
		<div class="form-group"
			  ng-class="{ 'has-error': signupForm.password_confirmation.$touched && signupForm.password_confirmation.$invalid }">
			<h5>
			<label class="control-label">Confirm Password</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-key" aria-hidden="true"></i>
				</div>
				<input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
						 placeholder="Confirm Password&hellip;" match-password="password"
						 ng-model="signupData.password_confirmation" ng-minlength="8" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.password_confirmation.$error"
				  ng-if="signupForm.password_confirmation.$touched" ng-hide="signupForm.password_confirmation.$valid">

				<p ng-message="passwordMatch">Password and confirmation do not match.</p>

			</div>
		</div>

		<!--start organization fields-->
		<p>Please enter your organization information</p>

		<!--org name-->
		<div class="form-group" ng-class="{ 'has-error': signupForm.orgName.$touched && signupForm.orgName.$invalid }">
			<h5>
			<label class="control-label" for="orgName">Organization Name</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="orgName" name="orgName" placeholder="Organization"
						 ng-model="signupData.orgName" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.orgName.$error"
				  ng-if="signupForm.orgName.$touched" ng-hide="signupForm.orgName.$valid">
				<p ng-message="required">Please enter your organization name.</p>
			</div>
		</div>

		<!--org address 1-->
		<div class="form-group"
			  ng-class="{ 'has-error': signupForm.orgAddress1.$touched && signupForm.orgAddress1.$invalid }">
			<label class="control-label" for="orgAddress1">Organization Address</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="address1" name="orgAddress1" placeholder="Address 1"
						 ng-model="signupData.orgAddress1" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.orgAddress1.$error"
				  ng-if="signupForm.orgAddress1.$touched" ng-hide="signupForm.orgAddress1.$valid">
				<p ng-message="required">Please enter your address.</p>
			</div>
		</div>

		<!--org address 2-->
		<div class="form-group"
			  ng-class="{ 'has-error': signupForm.orgAddress2.$touched && signupForm.orgAddress2.$invalid }">
			<label class="control-label sr-only" for="orgAddress2">Address 2</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="orgAddress2" name="orgAddress2" placeholder="Address 2"
						 ng-model="signupData.orgAddress2" ng-required="false"/>
			</div>
		</div>

		<!--city-->
		<div class="form-inline">
			<div class="form-group" ng-class="{ 'has-error': signupForm.orgCity.$touched && signupForm.orgCity.$invalid }">

				<label class="control-label" for="orgCity">City</label>

				<div class="input-group">
					<select class="form-control" id="orgCity" name="orgCity" ng-model="signupData.orgCity"
							  ng-required="true">
						<option selected>Albuquerque</option>
					</select>
				</div>
			</div>

			<!--state--->
			<div class="form-group"
				  ng-class="{ 'has-error': signupForm.orgState.$touched && signupForm.orgState.$invalid }">

				<label class="control-label" for="state">State</label>

				<div class="input-group">
					<select class="form-control" id="orgState" name="orgState" ng-model="signupData.orgState"
							  ng-required="true">
						<option>NM</option>
					</select>
				</div>
			</div>

			<!--zip-->
			<div class="form-group" ng-class="{ 'has-error': signupForm.orgZip.$touched && signupForm.orgZip.$invalid }">

				<label class="control-label" for="orgZip">Zip</label>

				<div class="input-group">

					<input type="text" class="form-control" id="orgZip" name="orgZip" placeholder="Zip"
							 ng-model="signupData.orgZip"
							 ng-required="true"
							 ng-pattern="/^(\d{5}-\d{4}|\d{5})$/"/>
				</div>
				<div class="alert alert-danger" role="alert" ng-messages="signupForm.orgZip.$error"
					  ng-if="signupForm.orgZip.$touched" ng-hide="signupForm.orgZip.$valid">
					<p ng-message="required">Please enter your organization phone number.</p>
					<p ng-message="pattern">Please enter a valid zip code.</p>
				</div>
			</div>
		</div>
		<br/><br/>
		<!--phone number-->
		<div class="form-group" ng-class="{ 'has-error': signupForm.orgPhone.$touched && signupForm.orgPhone.$invalid }">
			<h5>
			<label class="control-label" for="orgPhone">Organization Phone</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="orgPhone" name="orgPhone" placeholder="Organization Phone"
						 ng-model="signupData.orgPhone" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.orgPhone.$error"
				  ng-if="signupForm.orgPhone.$touched" ng-hide="signupForm.orgPhone.$valid">
				<p ng-message="required">Please enter your organization phone number.</p>
			</div>
		</div>
		<!--hours-->
		<div class="form-group" ng-class="{ 'has error' : signupForm.orgHours.$touched && signupForm.orgHours.$invalid }">
			<h5>
			<label class="control-label" for="orgHours">Hours</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="orgHours" name="orgHours" placeholder="Hours"
						 ng-model="signupData.orgHours" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupForm.orgHours.$error"
				  ng-if="signupForm.orgHours.$touched" ng-hide="signupForm.orgHours.$valid">
				<p ng-message="required">Please enter your hours</p>
			</div>
		</div>
		<!--description-->
		<div class="form-group"
			  ng-class="{ 'has error' : signupForm.orgDescription.$touched && signupForm.orgDescription.$invalid }">
			<h5>
			<label class="control-label" for="orgDescription">Description</label>
			</h5>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</div>
				<textarea class="form-control" rows="3" id="orgDescription" name="orgDescription"
							 placeholder="Description (Optional)" ng-model="signupData.orgDescription"
							 ng-required="false"></textarea>
			</div>
		</div>
		<!--type-->
		<div class="form-group" ng-class="{ 'has-error': signupForm.orgType.$touched && signupForm.orgType.$invalid }">
			<h5>
			<label class="control-label" for="orgType">Organization Type</label>
			</h5>
			<div class="input-group">
				<select class="form-control" id="orgType" name="orgType" ng-model="signupData.orgType" ng-required="true">
					<option value="">&mdash;SELECT AN OPTION&mdash;</option>
					<option value="G">We would like to donate food.</option>
					<option value="R">We are a shelter or food bank needing donations.</option>


				</select>
			</div>
		</div>
	</div>
<div class="modal-footer">
		<button type="submit" class="btn btn-lg btn-primary" ng-click="ok();" ng-disabled="signupForm.$invalid"><i
				class="fa fa-check" aria-hidden="true"></i>Submit
		</button>
		<button type="reset" class="btn btn-lg btn-warning" ng-click="cancel();"><i class="fa fa-ban"
																											 aria-hidden="true"></i> Cancel
		</button>
	</form>
</div>