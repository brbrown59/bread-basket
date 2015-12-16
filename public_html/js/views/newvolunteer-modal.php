<div class="modal-header">
	<h3>Create New Volunteer</h3>
</div>
<div class="modal-body">
	<form id="volunteerForm" name="volunteerForm"  ng-submit="createVolunteer(volunteer, volunteerForm.$valid);" ng-hide="isEditing">
		<!--begin new volunteer-->
		<!--first name-->
		<label class="control-label" for="volFirstName">Name</label>
		<div class="form-group form-inline form-group-lg" ng-class="{ 'has-error' : volunteerForm.volFirstName.$touched && volunteerForm.volFirstName.$invalid }">
			<label class="control-label sr-only" for="volFirstName">Name</label>
			<div class="input-group form-margin">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="volFirstName" name="volFirstName" placeholder="First Name" ng-model="volunteer.volFirstName" ng-required="true">
			</div>

			<div class="alert alert-danger form-group form-inline" role="alert" ng-messages="volunteerForm.volFirstName.$error" ng-if="volunteerForm.volFirstName.$touched" ng-hide="volunteerForm.volFirstName.$valid">
				<p ng-message="required">Please enter a first name</p>
			</div>

			<!--last name-->
		<div class="form-group form-inline form-group-lg" ng-class="{ 'has-error' : volunteerForm.volLastName.$touched && volunteerForm.volLastName.$invalid }">
			<label class="control-label sr-only" for="volLastName">Last Name</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="volLastName" name="volLastName" placeholder="Last Name" ng-model="volunteer.volLastName" ng-required="true">
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.volLastName.$error" ng-if="volunteerForm.volLastName.$touched" ng-hide="volunteerForm.volLastName.$valid">
				<p ng-message="required">Please enter a last name</p>
			</div>
		</div>
		</div>
		<!--contact info-->
		<label class="control-label" for="volvolEmail">Contact</label>
		<div class="form-group form-group-lg" ng-class="{ 'has-error': volunteerForm.volEmail.$touched && volunteerForm.volEmail.$invalid }">
			<!--volEmail-->
			<label class="control-label sr-only" for="volEmail">Email</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				</div>
				<input type="email" class="form-control" id="volEmail" name="volEmail" placeholder="Email" ng-model="volunteer.volEmail" ng-required="true" />
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.volEmail.$error" ng-if="volunteerForm.volEmail.$touched" ng-hide="volunteerForm.volEmail.$valid">
				<p ng-message="email">Email is invalid.</p>
				<p ng-message="required">Please enter a valid email.</p>
			</div>
		</div>
			<!--volPhone-->
			<div class="form-group form-group-lg" ng-class="{ 'has-error': volunteerForm.volPhone.$touched && volunteerForm.volPhone.$invalid }">
			<label class="control-label sr-only " for="volPhone">Phone</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="volPhone" name="volPhone" placeholder="Phone" ng-model="volunteer.volPhone" ng-required="true" />
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.volPhone.$error" ng-if="volunteerForm.volPhone.$touched" ng-hide="volunteerForm.volPhone.$valid">
				<p ng-message="required">Please enter a phone number.</p>
			</div>
</div>
</div>

<div class="modal-footer">
	<button type="submit" class="btn btn-primary" ng-click="ok();" ng-disabled="volunteerForm.$invalid"><i class="fa fa-check" aria-hidden="true"></i>Submit</button>
	<button type="reset" class="btn btn-warning" ng-click="cancel();"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
	</form>
</div>