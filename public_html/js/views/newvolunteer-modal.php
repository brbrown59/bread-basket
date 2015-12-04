//modal form for creating a new volunteer


<div class="modal-body">
	<form id="volunteerForm" name="volunteerForm" ng-submit="createVolunteer(newVolunteer, addVolunteerForm.$valid);" ng-hide="isEditing">
		<h3>Create New Volunteer</h3>
		<hr/>
		<!--begin new volunteer-->
		<!--first name-->
		<label class="control-label" for="firstName">Name</label>
		<div class="form-inline form-group-lg" ng-class="{ 'has-error' : volunteerForm.firstName.$touched && volunteerForm.firstName.$invalid }">
			<label class="control-label sr-only" for="firstName">Name</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="firstName" name="firstName" placeholder="First Name" ng-model="newVolunteer.firstName" ng-required="true">
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.firstName.$error" ng-if="volunteerForm.firstName.$touched" ng-hide="volunteerForm.firstName.$valid">
				<p ng-message="required">Please enter a first name</p>
			</div>
			<!--last name-->
			<label class="control-label sr-only" for="lastName">Last Name</label>
			<input type="text" class="form-control" id="lastName" name="lastName" placeholder="Last Name" ng-model="newVolunteer.lastName" ng-required="true">
			<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.lastName.$error" ng-if="volunteerForm.lastName.$touched" ng-hide="volunteerForm.lastName.$valid">
			<p ng-message="required">Please enter a last name</p>
			</div>
		</div>
		<!--contact info-->
		<label class="control-label" for="firstName">Contact</label>
		<div class="form-inline form-group-lg" ng-class="{ 'has-error': volunteerForm.email.$touched && volunteerForm.email.$invalid }">
			<!--email-->
			<label class="control-label sr-only" for="email">Email</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				</div>
				<input type="email" class="form-control" id="email" name="email" placeholder="Email" ng-model="newVolunteer.email" ng-required="true" />
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
				<input type="text" class="form-control" id="phone" name="phone" placeholder="Phone" ng-model="newVolunteer.phone" ng-required="true" />
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.phone.$error" ng-if="volunteerForm.phone.$touched" ng-hide="volunteerForm.phone.$valid">
				<p ng-message="required">Please enter a phone number.</p>
			</div>
		<button type="submit" class="btn btn-lg btn-info" ng-click="ok();" ng-disabled="volunteerForm.$invalid"><i class="fa fa-check" aria-hidden="true"></i>Submit</button>
		<button type="reset" class="btn btn-lg btn-warning" ng-click="cancel();"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
	</form>
</div>
</div>