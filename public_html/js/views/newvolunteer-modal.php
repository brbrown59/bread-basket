<form class="form-horizontal well" id="volunteerForm" name="volunteerForm">
	<h3>Create New Volunteer</h3>
	<hr/>
	<!--begin new volunteer-->
	<!--first name-->
	<label class="control-label" for="firstname">Name</label>
	<div class="form-inline form-group-lg" ng-class="{ 'has-error' : volunteerForm.firstname.$touched && volunteerForm.firstname.$invalid }">
		<label class="control-label sr-only" for="firstname">Name</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" ng-model="volData.firstname" ng-required="true">
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.firstname.$error" ng-if="volunteerForm.firstname.$touched" ng-hide="volunteerForm.firstname.$valid">
			<p ng-message="required">Please enter a first name</p>
		</div>
		<!--last name-->
		<label class="control-label sr-only" for="lastname">Last Name</label>
		<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Last Name" ng-model="volData.lastname" ng-required="true">
		<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.lastname.$error" ng-if="volunteerForm.lastname.$touched" ng-hide="volunteerForm.lastname.$valid">
		<p ng-message="required">Please enter a last name</p>
		</div>
	</div>
	<!--contact info-->
	<label class="control-label" for="firstname">Contact</label>
	<div class="form-inline form-group-lg" ng-class="{ 'has-error': volunteerForm.email.$touched && volunteerForm.email.$invalid }">
		<!--email-->
		<label class="control-label sr-only" for="email">Email</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
			</div>
			<input type="email" class="form-control" id="email" name="email" placeholder="Email" ng-model="volData.email" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.email.$error" ng-if="volunteerForm.email.$touched" ng-hide="volunteerForm.email.$valid">
			<p ng-message="email">Email is invalid.</p>
			<p ng-message="required">Please enter an email.</p>
		</div>
		<!--phone-->
		<label class="control-label sr-only " for="phone">Phone</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" ng-model="volData.phone" ng-required="true" />
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.phone.$error" ng-if="volunteerForm.phone.$touched" ng-hide="volunteerForm.phone.$valid">
			<p ng-message="required">Please enter a phone number.</p>
		</div>
		<hr />
		<h4>Is this person an administrator?</h4>
		<div class="checkbox ">
			<label>
				<input type="checkbox" name="isAdmin" id="isAdmin" value="">
				Check to create new administrator.
			</label>
		</div>
	</div>
	<hr />
	<button type="submit" class="btn btn-lg btn-info" ng-click="ok();" ng-disabled="volunteerForm.$invalid"><i class="fa fa-check" aria-hidden="true"></i>Submit</button>
	<button type="reset" class="btn btn-lg btn-warning" ng-click="cancel();"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
</form>