<form id="signupForm" name="signupForm" class="form-horizontal well">
	<h2>Join Us!</h2>
	<hr />
	<!--first name-->
	<div class="form-group" ng-class="{ 'has-error' : signupForm.firstName.$touched && signupForm.firstName.$invalid }">
		<label class="control-label" for="firstName">First Name</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" ng-model="signupData.name" ng-required="true"/>
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.firstName.$error" ng-if="signupForm.firstName.$touched" ng-hide="signupForm.firstName.$valid">
			<p ng-message="required">Please enter your first name</p>
		</div>
	</div>
	<!--last name-->
	<div class="form-group" ng-class="{ 'has error' : signupForm.lastName.$touched && signupForm.lastName.$invalid }">
		<label class="control-label" for="lastName">Last Name</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" ng-model="signupData.lastName" ng-required="true"/>
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.lastName.$error" ng-if="signupForm.lastName.$touched" ng-hide="signupForm.lastName.$valid">
			<p ng-message="required">Please enter your last name</p>
		</div>
	</div>
	<!--email-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.email.$touched && signupForm.email.$invalid }">
		<label class="control-label" for="email">Email</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
			</div>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" ng-model="signupData.email" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.email.$error" ng-if="signupForm.email.$touched" ng-hide="signupForm.email.$valid">
			<p ng-message="email">Email is invalid.</p>
			<p ng-message="required">Please enter your Email.</p>
		</div>
	</div>
	<!--phone number-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.phone.$touched && signupForm.phone.$invalid }">
		<label class="control-label" for="phone">Phone</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" ng-model="signupData.phone" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.phone.$error" ng-if="signupForm.phone.$touched" ng-hide="signupForm.phone.$valid">
			<p ng-message="required">Please enter your phone number.</p>
		</div>
	</div>
	<!--password-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.password.$touched && signupForm.password.$invalid }">
		<label class="control-label" for="password">Password</label>
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-key" aria-hidden="true"></i>
			</div>
			<input type="password" class="form-control" id="password" name="password" placeholder="Password&hellip;" ng-model="signupData.password" ng-minlength="8" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.password.$error" ng-if="signupForm.password.$touched" ng-hide="signupForm.password.$valid">
			<p ng-message="minlength">Password must be at least 8 characters.</p>
			<p ng-message="required">Please enter your password.</p>
		</div>
	</div>
	<div class="form-group" ng-class="{ 'has-error': signupForm.password_confirmation.$touched && signupForm.password_confirmation.$invalid }">
		<label class="control-label">Confirm Password</label>
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-key" aria-hidden="true"></i>
			</div>
			<input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm Password&hellip;" match-password="password" ng-model="signupData.password_confirmation" ng-minlength="8" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.password_confirmation.$error" ng-if="signupForm.password_confirmation.$touched" ng-hide="signupForm.password_confirmation.$valid">
			<p ng-message="minlength">Password must be at least 8 characters.</p>
			<p ng-message="passwordMatch">Passwords do not match.</p>
			<p ng-message="required">Please enter your password.</p>
		</div>
	</div>
	<!--start organization fields-->
	<p>Please enter your organization information</p>
	<!--org name-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.orgName.$touched && signupForm.orgName.$invalid }">
		<label class="control-label" for="orgName">Organization Name</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="orgName" name="orgName" placeholder="Organization" ng-model="signupData.orgName" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.orgName.$error" ng-if="signupForm.orgName.$touched" ng-hide="signupForm.orgName.$valid">
			<p ng-message="required">Please enter your organization name.</p>
		</div>
	</div>
	<!--org address 1-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.address1.$touched && signupForm.address1.$invalid }">
		<label class="control-label" for="address1">Organization Address</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-home" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="address1" name="address1" placeholder="Address 1" ng-model="signupData.address1" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.address1.$error" ng-if="signupForm.address1.$touched" ng-hide="signupForm.address1.$valid">
			<p ng-message="required">Please enter your address.</p>
		</div>
	</div>
	<!--org address 2-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.address2.$touched && signupForm.address2.$invalid }">
		<label class="control-label sr-only" for="address2">Address 2</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-none" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="address2" name="address2" placeholder="Address 2" ng-model="signupData.address2" ng-required="false" />
		</div>
	</div>
	<!--city-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.city.$touched && signupForm.city.$invalid }">
		<label class="control-label" for="city">City</label>
		<div class="input-group">
			<select  class="form-control" id="city" name="city" ng-model="signupData.city" ng-required="true">
				<option>Albuquerque</option>
			</select>
		</div>
	</div>
	<!--state-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.state.$touched && signupForm.state.$invalid }">
		<label class="control-label" for="state">State</label>
		<div class="input-group">
			<select  class="form-control" id="state" name="state" ng-model="signupData.state" ng-required="true">
				<option>NM</option>
			</select>
		</div>
	</div>
	<!--zip-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.zip.$touched && signupForm.zip.$invalid }">
		<label class="control-label" for="zip">Zip 2</label>
		<div class="input-group">

			<input type="text" class="form-control" id="zip" name="zip" placeholder="Zip " ng-model="signupData.zip" ng-required="true" />
		</div>
	</div>
	<!--phone number-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.orgPhone.$touched && signupForm.orgPhone.$invalid }">
		<label class="control-label" for="orgPhone">Organization Phone</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-earphone" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="orgPhone" name="orgPhone" placeholder="Organization Phone" ng-model="signupData.orgPhone" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.orgPhone.$error" ng-if="signupForm.orgPhone.$touched" ng-hide="signupForm.orgPhone.$valid">
			<p ng-message="required">Please enter your organization phone number.</p>
		</div>
	</div>
	<!--hours-->
	<div class="form-group" ng-class="{ 'has error' : signupForm.hours.$touched && signupForm.hours.$invalid }">
		<label class="control-label" for="hours">Hours</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-time" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="hours" name="hours" placeholder="Hours" ng-model="signupData.hours" ng-required="true"/>
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.hours.$error" ng-if="signupForm.hours.$touched" ng-hide="signupForm.hours.$valid">
			<p ng-message="required">Please enter your hours</p>
		</div>
	</div>
	<!--description-->
	<div class="form-group" ng-class="{ 'has error' : signupForm.hours.$touched && signupForm.hours.$invalid }">
		<label class="control-label" for="hours">Hours</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			</div>
			<textarea class="form-control" rows="3" id="description" name="description" placeholder="Description (Optional)" ng-model="signupData.description" ng-required="false"></textarea>
		</div>
	</div>
	<hr />
	<button type="submit" class="btn btn-lg btn-info" ng-click="ok();" ng-disabled="signupForm.$invalid"><i class="fa fa-check" aria-hidden="true"></i>Submit</button>
	<button type="reset" class="btn btn-lg btn-warning" ng-click="cancel();"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
</form>