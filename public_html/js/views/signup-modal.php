<form id="signupForm" name="signupForm" class="form-horizontal well">
	<h2>Join Us!</h2>
	<hr />
	<!--first name-->
	<div class="form-group" ng-class="{ 'has-error' : signupForm.firstname.$touched %% signupForm.firstname.$invalid }">
		<label class="control-label" for="firstname">First Name</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" ng-model="signupData.name" ng-required="true"/>
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.firstname.$error" ng-if="signupForm.firstname.$touched" ng-hide="signupForm.firstname.$valid">
			<p ng-message="required">Please enter your first name</p>
		</div>
	</div>
	<!--last name-->
	<div class="form-group" ng-class="{ 'has error' : signupForm.lastname.$touched && signupForm.lastname.$invalid }">
		<label class="control-label" for="lastname">Last Name</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" ng-model="signupData.lastname" ng-required="true"/>
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.lastname.$error" ng-if="signupForm.lastname.$touched" ng-hide="signupForm.lastname.$valid">
			<p ng-message="required">Please enter your last anme</p>
		</div>
	</div>
	<!--email-->
	<div class="form-group" ng-class="{ 'has-error': signupForm.email.$touched && signupForm.email.$invalid }">
		<label class="control-label" for="email">Email</label>
		<div class="input-group">
			<div class="input-group-addon">
				<i class="glyphicon glyphicon-envelope" aria-hidden="true"></i>
			</div>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" ng-model="signupData.email" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.email.$error" ng-if="signupForm.email.$touched" ng-hide="signupForm.email.$valid">
			<p ng-message="email">Email is invalid.</p>
			<p ng-message="required">Please enter your Email.</p>
		</div>
	</div>
	<!--phone number-->

</form>