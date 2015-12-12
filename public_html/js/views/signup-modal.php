<div class="modal-body">
	<form id="signupForm" name="signupForm">
		<h2>Join Us!</h2>
		<hr/>
		<!--first name-->
		<label class="control-label" for="name">Name</label>

		<div class="form-inline"
			  ng-class="{ 'has-error' : signupData.volFirstName.$touched && signupData.volFirstName.$invalid }">
			<label class="control-label sr-only" for="volFirstName">First Name</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="volFirstName" name="volFirstName" placeholder="First Name"
						 ng-model="signupData.volFirstName" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.volFirstName.$error"
				  ng-if="signupData.volFirstName.$touched" ng-hide="signupData.volFirstName.$valid">
				<p ng-message="required">Please enter your first name</p>
			</div>

			<!--last name-->
			<label class="control-label sr-only" for="volLastName">Last Name</label>

			<div class="input-group">
				<input type="text" class="form-control" id="volLastName" name="volLastName" placeholder="Last Name"
						 ng-model="signupData.volLastName" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.volLastName.$error"
				  ng-if="signupData.volLastName.$touched" ng-hide="signupData.volLastName.$valid">
				<p ng-message="required">Please enter your last name</p>
			</div>

		</div>

		<!--email-->
		<div class="form-group" ng-class="{ 'has-error': signupData.volEmail.$touched && signupData.volEmail.$invalid }">
			<label class="control-label" for="volEmail">Email</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				</div>
				<input type="email" class="form-control" id="volEmail" name="volEmail" placeholder="Email"
						 ng-model="signupData.volEmail" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.volEmail.$error"
				  ng-if="signupData.volEmail.$touched" ng-hide="signupData.volEmail.$valid">
				<p ng-message="volEmail">Email is invalid.</p>

				<p ng-message="required">Please enter your Email.</p>
			</div>
		</div>

		<!--phone number-->
		<div class="form-group" ng-class="{ 'has-error': signupData.volPhone.$touched && signupData.volPhone.$invalid }">
			<label class="control-label" for="phone">Phone</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
						 ng-model="signupData.volPhone" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.volPhone.$error"
				  ng-if="signupData.volPhone.$touched" ng-hide="signupData.volPhone.$valid">
				<p ng-message="required">Please enter your phone number.</p>
			</div>
		</div>

		<!--password-->
		<div class="form-group" ng-class="{ 'has-error': signupData.password.$touched && signupData.password.$invalid }">
			<label class="control-label" for="password">Password</label>

			<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-key" aria-hidden="true"></i>
				</div>
				<input type="password" class="form-control" id="password" name="password" placeholder="Password&hellip;"
						 ng-model="signupData.password" ng-minlength="8" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.password.$error"
				  ng-if="signupData.password.$touched" ng-hide="signupData.password.$valid">
				<p ng-message="minlength">Password must be at least 8 characters.</p>

				<p ng-message="required">Please enter your password.</p>
			</div>
		</div>
		<div class="form-group"
			  ng-class="{ 'has-error': signupData.password_confirmation.$touched && signupData.password_confirmation.$invalid }">
			<label class="control-label">Confirm Password</label>

			<div class="input-group">
				<div class="input-group-addon">
					<i class="fa fa-key" aria-hidden="true"></i>
				</div>
				<input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
						 placeholder="Confirm Password&hellip;" match-password="password"
						 ng-model="signupData.password_confirmation" ng-minlength="8" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.password_confirmation.$error"
				  ng-if="signupData.password_confirmation.$touched" ng-hide="signupData.password_confirmation.$valid">
				<p ng-message="minlength">Password must be at least 8 characters.</p>

				<p ng-message="passwordMatch">Passwords do not match.</p>

				<p ng-message="required">Please enter your password.</p>
			</div>
		</div>

		<!--start organization fields-->
		<p>Please enter your organization information</p>

		<!--org name-->
		<div class="form-group" ng-class="{ 'has-error': signupData.orgName.$touched && signupData.orgName.$invalid }">
			<label class="control-label" for="orgName">Organization Name</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="orgName" name="orgName" placeholder="Organization"
						 ng-model="signupData.orgName" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.orgName.$error"
				  ng-if="signupData.orgName.$touched" ng-hide="signupData.orgName.$valid">
				<p ng-message="required">Please enter your organization name.</p>
			</div>
		</div>

		<!--org address 1-->
		<div class="form-group"
			  ng-class="{ 'has-error': signupData.orgAddress1.$touched && signupData.orgAddress1.$invalid }">
			<label class="control-label" for="orgAddress1">Organization Address</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="address1" name="orgAddress1" placeholder="Address 1"
						 ng-model="signupData.orgAddress1" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.orgAddress1.$error"
				  ng-if="signupData.orgAddress1.$touched" ng-hide="signupData.orgAddress1.$valid">
				<p ng-message="required">Please enter your address.</p>
			</div>
		</div>

		<!--org address 2-->
		<div class="form-group"
			  ng-class="{ 'has-error': signupData.orgAddress2.$touched && signupData.orgAddress2.$invalid }">
			<label class="control-label sr-only" for="orgAddress2">Address 2</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-none" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="orgAddress2" name="orgAddress2" placeholder="Address 2"
						 ng-model="signupData.orgAddress2" ng-required="false"/>
			</div>
		</div>

		<!--city-->
		<div class="form-inline">
			<div class="form-group" ng-class="{ 'has-error': signupData.orgCity.$touched && signupData.orgCity.$invalid }">
				<label class="control-label" for="orgCity">City</label>

				<div class="input-group">
					<select class="form-control" id="orgCity" name="orgCity" ng-model="signupData.orgCity"
							  ng-required="true">
						<option>Albuquerque</option>
					</select>
				</div>
			</div>

			<!--state-->
			<div class="form-group"
				  ng-class="{ 'has-error': signupData.orgState.$touched && signupData.orgState.$invalid }">
				<label class="control-label" for="state">State</label>

				<div class="input-group">
					<select class="form-control" id="orgState" name="orgState" ng-model="signupData.orgState"
							  ng-required="true">
						<option>NM</option>
					</select>
				</div>
			</div>

			<!--zip-->
			<div class="form-group" ng-class="{ 'has-error': signupData.orgZip.$touched && signupData.orgZip.$invalid }">
				<label class="control-label" for="orgZip">Zip</label>

				<div class="input-group">

					<input type="text" class="form-control" id="orgZip" name="orgZip" placeholder="Zip"
							 ng-model="signupData.orgZip"
							 ng-required="true"/>
				</div>
			</div>
		</div>
		<br/><br/>
		<!--phone number-->
		<div class="form-group" ng-class="{ 'has-error': signupData.orgPhone.$touched && signupData.orgPhone.$invalid }">
			<label class="control-label" for="orgPhone">Organization Phone</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="orgPhone" name="orgPhone" placeholder="Organization Phone"
						 ng-model="signupData.orgPhone" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.orgPhone.$error"
				  ng-if="signupData.orgPhone.$touched" ng-hide="signupData.orgPhone.$valid">
				<p ng-message="required">Please enter your organization phone number.</p>
			</div>
		</div>
		<!--hours-->
		<div class="form-group" ng-class="{ 'has error' : signupData.orgHours.$touched && signupData.orgHours.$invalid }">
			<label class="control-label" for="orgHours">Hours</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="orgHours" name="orgHours" placeholder="Hours"
						 ng-model="signupData.orgHours" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.orgHours.$error"
				  ng-if="signupData.orgHours.$touched" ng-hide="signupData.orgHours.$valid">
				<p ng-message="required">Please enter your hours</p>
			</div>
		</div>
		<!--description-->
		<div class="form-group"
			  ng-class="{ 'has error' : signupData.orgDescription.$touched && signupData.orgDescription.$invalid }">
			<label class="control-label" for="orgDescription">Description</label>

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
		<div class="form-group" ng-class="{ 'has-error': signupData.orgType.$touched && signupData.orgType.$invalid }">
			<label class="control-label" for="orgType">Organization Type</label>

			<div class="input-group">
				<select class="form-control" id="orgType" name="orgType" ng-model="signupData.orgType" ng-required="true">
					<option>G</option>
				</select>
			</div>
		</div>
		<hr/>
		<button type="submit" class="btn btn-lg btn-info" ng-click="ok();" ng-disabled="signupData.$invalid"><i
				class="fa fa-check" aria-hidden="true"></i>Submit
		</button>
		<button type="reset" class="btn btn-lg btn-warning" ng-click="cancel();"><i class="fa fa-ban"
																											 aria-hidden="true"></i> Cancel
		</button>
	</form>
</div>