<div class="modal-body">
	<form id="signupForm" name="signupForm">
		<h2>Join Us!</h2>
		<hr/>
		<!--first name-->
		<label class="control-label" for="name">Name</label>

		<div class="form-inline"
			  ng-class="{ 'has-error' : signupData.firstName.$touched && signupData.firstName.$invalid }">
			<label class="control-label sr-only" for="firstName">First Name</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name"
						 ng-model="signupData.firstName" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.firstName.$error"
				  ng-if="signupData.firstName.$touched" ng-hide="signupData.firstName.$valid">
				<p ng-message="required">Please enter your first name</p>
			</div>
			<!--last name-->

			<label class="control-label sr-only" for="lastName">Last Name</label>

			<div class="input-group">
				<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name"
						 ng-model="signupData.lastName" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.lastName.$error"
				  ng-if="signupData.lastName.$touched" ng-hide="signupData.lastName.$valid">
				<p ng-message="required">Please enter your last name</p>
			</div>

		</div>
		<!--email-->
		<div class="form-group" ng-class="{ 'has-error': signupData.email.$touched && signupData.email.$invalid }">
			<label class="control-label" for="email">Email</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				</div>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email"
						 ng-model="signupData.email" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.email.$error"
				  ng-if="signupData.email.$touched" ng-hide="signupData.email.$valid">
				<p ng-message="email">Email is invalid.</p>

				<p ng-message="required">Please enter your Email.</p>
			</div>
		</div>
		<!--phone number-->
		<div class="form-group" ng-class="{ 'has-error': signupData.phone.$touched && signupData.phone.$invalid }">
			<label class="control-label" for="phone">Phone</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone"
						 ng-model="signupData.phone" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.phone.$error"
				  ng-if="signupData.phone.$touched" ng-hide="signupData.phone.$valid">
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
		<div class="form-group" ng-class="{ 'has-error': signupData.address1.$touched && signupData.address1.$invalid }">
			<label class="control-label" for="address1">Organization Address</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="address1" name="address1" placeholder="Address 1"
						 ng-model="signupData.address1" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.address1.$error"
				  ng-if="signupData.address1.$touched" ng-hide="signupData.address1.$valid">
				<p ng-message="required">Please enter your address.</p>
			</div>
		</div>
		<!--org address 2-->
		<div class="form-group" ng-class="{ 'has-error': signupData.address2.$touched && signupData.address2.$invalid }">
			<label class="control-label sr-only" for="address2">Address 2</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-none" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="address2" name="address2" placeholder="Address 2"
						 ng-model="signupData.address2" ng-required="false"/>
			</div>
		</div>
		<!--city-->
		<div class="form-inline">
			<div class="form-group" ng-class="{ 'has-error': signupData.city.$touched && signupData.city.$invalid }">
				<label class="control-label" for="city">City</label>

				<div class="input-group">
					<select class="form-control" id="city" name="city" ng-model="signupData.city" ng-required="true">
						<option>Albuquerque</option>
					</select>
				</div>
			</div>
			<!--state-->
			<div class="form-group" ng-class="{ 'has-error': signupData.state.$touched && signupData.state.$invalid }">
				<label class="control-label" for="state">State</label>

				<div class="input-group">
					<select class="form-control" id="state" name="state" ng-model="signupData.state" ng-required="true">
						<option>NM</option>
					</select>
				</div>
			</div>
			<!--zip-->
			<div class="form-group" ng-class="{ 'has-error': signupData.zip.$touched && signupData.zip.$invalid }">
				<label class="control-label" for="zip">Zip</label>

				<div class="input-group">

					<input type="text" class="form-control" id="zip" name="zip" placeholder="Zip " ng-model="signupData.zip"
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
		<div class="form-group" ng-class="{ 'has error' : signupData.hours.$touched && signupData.hours.$invalid }">
			<label class="control-label" for="hours">Hours</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="hours" name="hours" placeholder="Hours"
						 ng-model="signupData.hours" ng-required="true"/>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="signupData.hours.$error"
				  ng-if="signupData.hours.$touched" ng-hide="signupData.hours.$valid">
				<p ng-message="required">Please enter your hours</p>
			</div>
		</div>
		<!--description-->
		<div class="form-group" ng-class="{ 'has error' : signupData.hours.$touched && signupData.hours.$invalid }">
			<label class="control-label" for="description">Description</label>

			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</div>
				<textarea class="form-control" rows="3" id="description" name="description"
							 placeholder="Description (Optional)" ng-model="signupData.description"
							 ng-required="false"></textarea>
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