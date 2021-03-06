<?php
//need to account for the case where the validation fails (check the reply data for a not 200)
//needs a directive????

/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "Validation Log-In";
/*load head-utils*/
require_once("utilities.php");
?>

	<header>
		<div class="na-nav home-nav nav navbar-brand">
			<a href="home.php">
				<span class="glyphicon glyphicon-grain"></span>
				Bread Basket
			</a>
		</div>
	</header>

<div class="emailvalidation-bg sfooter-content">
	<main ng-controller="ValidationController">

		<div class="container form-padding">
			<div class="modal-header">
			<form id="signinForm" name="signinForm">
				<h3>E-mail successfully validated!  Please sign in:</h3>
			</div>
			<div class="modal-body">
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
			</div>
			<div class="modal-footer">
				<button type="submit" class="btn btn-primary" ng-click="signin(signinData, signinForm.$valid);" ng-disabled="signinForm.$invalid"><i
						class="fa fa-sign-in" aria-hidden="true"></i> Sign In
				</button>
				<button type="reset" class="btn btn-warning" ng-click="cancel();"><i class="fa fa-ban"
																													 aria-hidden="true"></i> Cancel
				</button>
			</form>
		</div>
		</div>
	</main>
</div>
<?php require_once("footer.php")?>
</body>
</html>
