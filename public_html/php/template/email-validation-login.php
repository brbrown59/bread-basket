<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Volunteers";
/*load head-utils*/
require_once("utilities.php");
/*load head-utilss*/
require_once("utilities.php");

?>

<main ng-controller="SigninController">

	<div class="container">
		<form id="signinForm" name="signinForm">
			<h2>E-mail successfully validated!  Please sign in:</h2>
			<hr/>
			<div class="form-group form-group-lg"
				  ng-class="{ 'has-error': signinForm.email.$touched && signinForm.email.$invalid }">
				<label class="control-label" for="email">Email</label>

				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-envelope" aria-hidden="true"></i>
					</div>
					<input type="email" class="form-control" id="email" name="email" placeholder="What's your Email?"
							 ng-model="signinData.email" ng-required="true"/>
				</div>
				<div class="alert alert-danger" role="alert" ng-messages="signinForm.email.$error"
					  ng-if="signinForm.email.$touched" ng-hide="signinForm.email.$valid">
					<p ng-message="email">Email is invalid.</p>

					<p ng-message="required">Please enter your Email.</p>
				</div>
			</div>
			<div class="form-group form-group-lg"
				  ng-class="{ 'has-error': signinForm.password.$touched && signinForm.password.$invalid }">
				<label class="control-label" for="password">Password</label>

				<div class="input-group">
					<div class="input-group-addon">
						<i class="fa fa-key" aria-hidden="true"></i>
					</div>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password&hellip;"
							 ng-model="signinData.password" ng-minlength="8" ng-required="true"/>
				</div>
				<div class="alert alert-danger" role="alert" ng-messages="signinForm.password.$error"
					  ng-if="signinForm.password.$touched" ng-hide="signinForm.password.$valid">
					<p ng-message="minlength">Password must be at least 8 characters.</p>

					<p ng-message="required">Please enter your password.</p>
				</div>
			</div>
			<hr/>
			<button type="submit" class="btn btn-lg btn-info" ng-click="ok();" ng-disabled="signinForm.$invalid"><i
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
