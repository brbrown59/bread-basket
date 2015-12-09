<div class="modal-body">
	<form id="editVolunteerForm" name="editVolunteerForm"  ng-submit="updateVolunteer(editedVolunteer, editVolunteerForm.$valid);" ng-hide="isEditing">
		<h3>Edit Volunteer</h3>
		<hr/>
		<!--begin new volunteer-->
		<!--first name-->
		<label class="control-label" for="volFirstName">Name</label>
		<div class="form-inline form-group-lg" ng-class="{ 'has-error' : editVolunteerForm.volFirstName.$touched && editVolunteerForm.volFirstName.$invalid }">
			<label class="control-label sr-only" for="volFirstName">Name</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="volFirstName" name="volFirstName" placeholder="First Name" ng-model="editedVolunteer.volFirstName" ng-required="true">
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="editVolunteerForm.volFirstName.$error" ng-if="editVolunteerForm.volFirstName.$touched" ng-hide="editVolunteerForm.volFirstName.$valid">
				<p ng-message="required">Please enter a first name</p>
			</div>



			<!--last name-->
			<label class="control-label sr-only" for="volLastName">Last Name</label>
			<input type="text" class="form-control" id="volLastName" name="volLastName" placeholder="Last Name" ng-model="editedVolunteer.volLastName" ng-required="true">
			<div class="alert alert-danger" role="alert" ng-messages="editVolunteerForm.volLastName.$error" ng-if="editVolunteerForm.volLastName.$touched" ng-hide="editVolunteerForm.volLastName.$valid">
				<p ng-message="required">Please enter a last name</p>
			</div>
		</div>
		<!--contact info-->
		<label class="control-label" for="volvolEmail">Contact</label>
		<div class="form-inline form-group-lg" ng-class="{ 'has-error': editVolunteerForm.volEmail.$touched && editVolunteerForm.volEmail.$invalid }">
			<!--volEmail-->
			<label class="control-label sr-only" for="volEmail">volEmail</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
				</div>
				<input type="email" class="form-control" id="volEmail" name="volEmail" placeholder="volEmail" ng-model="editedVolunteer.volEmail" ng-required="true" />
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="editVolunteerForm.volEmail.$error" ng-if="editVolunteerForm.volEmail.$touched" ng-hide="editVolunteerForm.volEmail.$valid">
				<p ng-message="email">Email is invalid.</p>
				<p ng-message="required">Please enter an Email.</p>
			</div>
			<!--volPhone-->
			<label class="control-label sr-only " for="volPhone">Phone</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
				</div>
				<input type="text" class="form-control" id="volPhone" name="volPhone" placeholder="Phone" ng-model="editedVolunteer.volPhone" ng-required="true" />
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="editVolunteerForm.volPhone.$error" ng-if="editVolunteerForm.volPhone.$touched" ng-hide="editVolunteerForm.volPhone.$valid">
				<p ng-message="required">Please enter a volPhone number.</p>
			</div>
			<button type="submit" class="btn btn-lg btn-info" ng-click="ok();" ng-disabled="editVolunteerForm.$invalid"><i class="fa fa-check" aria-hidden="true"></i>Submit</button>
			<button type="reset" class="btn btn-lg btn-warning" ng-click="cancel();"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
	</form>
</div>
</div>