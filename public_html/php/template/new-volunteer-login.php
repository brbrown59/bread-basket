<?php
//need to account for the case where the validation fails (check the reply data for a not 200)
//needs a directive????

/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "New Volunteer";
/*load head-utils*/
require_once("utilities.php");
?>

<main ng-controller="ValidationController">
	<div class="container">
		<form id="newvolForm" name="newvolForm">
			<h2>Welcome! Please verify your email and create a new password!</h2>
			<hr/>
			<div class="form-group"
				  ng-class="{ 'has-error': newvolData.password.$touched && newvolData.password.$invalid }">
				<label class="control-label" for="password">Password</label>

				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-key" aria-hidden="true"></i>
					</div>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password&hellip;"
							 ng-model="newvolData.password" ng-minlength="8" ng-required="true"/>
				</div>
				<div class="alert alert-danger" role="alert" ng-messages="newvolData.password.$error"
					  ng-if="newvolData.password.$touched" ng-hide="newvolData.password.$valid">
					<p ng-message="minlength">Password must be at least 8 characters.</p>

					<p ng-message="required">Please enter your password.</p>
				</div>
			</div>
			<div class="form-group"
				  ng-class="{ 'has-error': newvolData.password_confirmation.$touched && newvolData.password_confirmation.$invalid }">
				<label class="control-label">Confirm Password</label>

				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-key" aria-hidden="true"></i>
					</div>
					<input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
							 placeholder="Confirm Password&hellip;" match-password="password"
							 ng-model="newvolData.password_confirmation" ng-minlength="8" ng-required="true"/>
				</div>
				<div class="alert alert-danger" role="alert" ng-messages="newvolData.password_confirmation.$error"
					  ng-if="newvolData.password_confirmation.$touched" ng-hide="newvolData.password_confirmation.$valid">
					<p ng-message="minlength">Password must be at least 8 characters.</p>

					<p ng-message="passwordMatch">Passwords do not match.</p>

					<p ng-message="required">Please enter your password.</p>
				</div>
			</div>
			<!--email-->
			<div class="form-group"
				  ng-class="{ 'has-error': newvolData.volEmail.$touched && newvolData.volEmail.$invalid }">
				<label class="control-label" for="volEmail">Email</label>

				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
					</div>
					<input type="email" class="form-control" id="volEmail" name="volEmail" placeholder="Email"
							 ng-model="newvolData.volEmail" ng-required="true"/>
				</div>
				<div class="alert alert-danger" role="alert" ng-messages="newvolData.volEmail.$error"
					  ng-if="newvolData.volEmail.$touched" ng-hide="newvolData.volEmail.$valid">
					<p ng-message="volEmail">Email is invalid.</p>
					<p ng-message="required">Please enter your email.</p>
				</div>
			</div>
			<hr/>
			<button type="submit" class="btn btn-lg btn-info" ng-click="setVolPasswords(newvolData, newvolForm.$valid);"
					  ng-disabled="newvolForm.$invalid"><i
					class="fa fa-sign-in" aria-hidden="true"></i> Sign In
			</button>
			<button type="reset" class="btn btn-lg btn-warning" ng-click="cancel();"><i class="fa fa-ban"
																												 aria-hidden="true"></i> Cancel
			</button>
		</form>
	</div>
</main>
</body>
</html>
