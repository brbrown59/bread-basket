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

<header>
	<div class="na-nav home-nav nav navbar-brand">
		<a href="index.php">
			<span class="glyphicon glyphicon-grain"></span>
			Bread Basket
		</a>
	</div>
</header>

<div class="emailvalidation-bg sfooter-content">

<main ng-controller="ValidationController">
	<div class="container form-padding">
		<div class="modal-header">
			<h2>Welcome! Please verify your email and create a password.</h2>
		</div>
		<div class="modal-body">
		<form id="newvolForm" name="newvolForm">
			<div class="form-group"
				  ng-class="{ 'has-error': newvolForm.password.$touched && newvolForm.password.$invalid }">
				<h5>
					<label class="control-label" for="password">Password</label>
				</h5>
				<div class="input-group input-group-lg">
					<div class="input-group-addon">
						<i class="fa fa-key" aria-hidden="true"></i>
					</div>
					<input type="password" class="form-control" id="password" name="password" placeholder="Password&hellip;"
							 ng-model="newvolData.password" ng-minlength="8" ng-required="true"/>
				</div>
				<div class="alert alert-danger" role="alert"
					  ng-messages="newvolForm.password.$error"
					  ng-if="newvolForm.password.$touched"
					  ng-hide="newvolForm.password.$valid">
					<p ng-message="minlength">Password must be at least 8 characters.</p>
					<p ng-message="required">Please enter your password.</p>
				</div>
			</div>
			<div class="form-group"
				  ng-class="{ 'has-error': newvolFormpassword_confirmation.$touched && newvolForm.password_confirmation.$invalid }">
				<h5>
				<label class="control-label">Confirm Password</label>
				</h5>
				<div class="input-group input-group-lg">
					<div class="input-group-addon">
						<i class="fa fa-key" aria-hidden="true"></i>
					</div>
					<input type="password" class="form-control" id="password_confirmation" name="password_confirmation"
							 placeholder="Confirm Password&hellip;" match-password="password"
							 ng-model="newvolData.password_confirmation" ng-minlength="8" ng-required="true"/>
				</div>
				<div class="alert alert-danger" role="alert"
					  ng-messages="newvolForm.password_confirmation.$error"
					  ng-if="newvolForm.password_confirmation.$touched"
					  ng-hide="newvolForm.password_confirmation.$valid">
					<p ng-message="minlength">Password must be at least 8 characters.</p>
					<p ng-message="passwordMatch">Password and confirmation do not match.</p>
					<p ng-message="required">Please enter your password.</p>
				</div>
			</div>

			<!--email-->
			<div class="form-group"
				  ng-class="{ 'has-error': newvolForm.volEmail.$touched && newvolForm.volEmail.$invalid }">
				<h5>
					<label class="control-label" for="volEmail">Email</label>
				</h5>
				<div class="input-group input-group-lg">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
					</div>
					<input type="email" class="form-control" id="volEmail" name="volEmail" placeholder="Email"
							 ng-model="newvolData.volEmail" ng-required="true"/>
				</div>
				<div class="alert alert-danger" role="alert"
					  ng-messages="newvolForm.volEmail.$error"
					  ng-if="newvolForm.volEmail.$touched"
					  ng-hide="newvolForm.volEmail.$valid">
					<p ng-message="email">Email is invalid.</p>
					<p ng-message="required">Please enter your email.</p>
				</div>
			</div>
		</div>
		<div class="modal-footer">
			<button type="submit" class="btn btn-primary" ng-click="setVolPasswords(newvolData, newvolForm.$valid);"
					  ng-disabled="newvolForm.$invalid"><i
					class="fa fa-sign-in" aria-hidden="true"></i> Sign In
			</button>
			<button type="reset" class="btn btn-warning" ng-click="cancel();"><i class="fa fa-ban"
																												 aria-hidden="true"></i> Cancel
			</button>
		</form>
	</div>
</main>
</div>
</div>
</body>
</html>
