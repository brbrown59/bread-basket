<form id="signupForm" name="signupForm" class="form-horizontal well">
	<h2>Join the Fun!</h2>
	<hr />
	<div class="form-group" ng-class="{ 'has-error': signupForm.name.$touched && signupForm.name.$invalid }">
		<label class="control-label" for="name">Name</label>
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-user" aria-hidden="true"></i>
			</div>
			<input type="text" class="form-control" id="name" name="name" placeholder="What's your name?" ng-model="signupData.name" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.name.$error" ng-if="signupForm.name.$touched" ng-hide="signupForm.name.$valid">
			<p ng-message="required">Please enter your name.</p>
		</div>
	</div>
	<div class="form-group" ng-class="{ 'has-error': signupForm.email.$touched && signupForm.email.$invalid }">
		<label class="control-label" for="email">Email</label>
		<div class="input-group">
			<div class="input-group-addon">
				<i class="fa fa-envelope" aria-hidden="true"></i>
			</div>
			<input type="email" class="form-control" id="email" name="email" placeholder="What's your Email?" ng-model="signupData.email" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.email.$error" ng-if="signupForm.email.$touched" ng-hide="signupForm.email.$valid">
			<p ng-message="email">Email is invalid.</p>
			<p ng-message="required">Please enter your Email.</p>
		</div>
	</div>
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
	<hr />
	<button type="submit" class="btn btn-lg btn-info" ng-click="ok();" ng-disabled="signupForm.$invalid"><i class="fa fa-check" aria-hidden="true"></i> Join</button>
	<button type="reset" class="btn btn-lg btn-warning" ng-click="cancel();"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
</form>