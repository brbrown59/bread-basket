<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Volunteers";
/*load head-utils*/
require_once("utilities.php");

/*require once the header*/
require_once("header.php");

?>
			<!--main content-->
			<main ng-controller="VolunteerController">
				<!--this container houses the h1 tag/headline and the back to listing button-->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<h1>All Volunteers</h1>
						</div>
					</div>
				</div>
				<hr />
				<div class="container">
					<div class="row">
						<div class="col-xs-3">
							<a class="btn btn-default btn-lg" href="login-landing-page.php" role="button">Back</a>
						</div>
						<div class="col-xs-3">
							<button class="btn btn-info btn-lg" ng-click="openVolunteerModal();">New Volunteer</button>
						</div>
						<div class="col-xs-3">
							<button class="btn btn-info btn-lg" ng-click="setNewVolunteer();">Create Volunteer</button>
						</div>
					</div>
				</div>
				<hr />
				<div class="container">
					<!--CREATE Volunteer form-->
					<div class="row">
						<div class="col-md-12" ng-show="isCreating">
							<form name="volunteerForm" id="volunteerForm" class="form-horizontal well" ng-submit="createVolunteer(volunteer, volunteerForm.$valid);"  ng-hide="isEditing" novalidate>
								<h2>Create Volunteer</h2>
								<hr />
								<div class="form-group" ng-class="{ 'has-error': volunteerForm.volunteer.$touched && volunteerForm.volunteer.$invalid }">
									<label class="control-label" for="volFirstName">Name</label>
									<div class="form-group-lg" ng-class="{ 'has-error' : volunteerForm.volFirstName.$touched && volunteerForm.volFirstName.$invalid }">
										<label class="control-label sr-only" for="volFirstName">Name</label>
										<div class="input-group">
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
											</div>
											<input type="text" class="form-control" id="volFirstName" name="volFirstName" placeholder="First Name" ng-model="newVolunteer.volFirstName" ng-required="true">
										</div>
										<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.volFirstName.$error" ng-if="volunteerForm.volFirstName.$touched" ng-hide="volunteerForm.volFirstName.$valid">
											<p ng-message="required">Please enter a first name</p>
										</div>
										<br />

										<!--last name-->
										<label class="control-label sr-only" for="volLastName">Last Name</label>
										<div class="input-group">
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
											</div>
											<input type="text" class="form-control" id="volLastName" name="volLastName" placeholder="Last Name" ng-model="newVolunteer.volLastName" ng-required="true">
										</div>
										<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.volLastName.$error" ng-if="volunteerForm.volLastName.$touched" ng-hide="volunteerForm.volLastName.$valid">
											<p ng-message="required">Please enter a last name</p>
										</div>
									</div>
									<br />
									<!--contact info-->
									<label class="control-label" for="volvolEmail">Contact</label>
									<div class="form-group-lg" ng-class="{ 'has-error': volunteerForm.volEmail.$touched && volunteerForm.volEmail.$invalid }">
										<!--volEmail-->
										<label class="control-label sr-only" for="volEmail">volEmail</label>
										<div class="input-group">
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
											</div>
											<input type="email" class="form-control" id="volEmail" name="volEmail" placeholder="Email" ng-model="newVolunteer.volEmail" ng-required="true" />
										</div>
										<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.volEmail.$error" ng-if="volunteerForm.volEmail.$touched" ng-hide="volunteerForm.volEmail.$valid">
											<p ng-message="email">Email is invalid.</p>
											<p ng-message="required">Please enter an Email.</p>
										</div>
										<br />
										<!--volPhone-->
										<label class="control-label sr-only " for="volPhone">Phone</label>
										<div class="input-group">
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-phone" aria-hidden="true"></span>
											</div>
											<input type="text" class="form-control" id="volPhone" name="volPhone" placeholder="Phone" ng-model="newVolunteer.volPhone" ng-required="true" />
										</div>
										<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.volPhone.$error" ng-if="volunteerForm.volPhone.$touched" ng-hide="volunteerForm.volPhone.$valid">
											<p ng-message="required">Please enter a volPhone number.</p>
										</div>
									</div>
									<br />
									<button type="submit" class="btn btn-info btn-lg" ng-disabled="volunteerForm.$invalid"><i class="fa fa-share"></i> Volunteer</button>
									<button type="reset" class="btn btn-warning btn-lg" ng-click="cancelCreating();"><i class="fa fa-ban"></i> Cancel</button>
								</div>
							</form>
						</div>
					</div>



					<!--EDIT Volunteer form-->
					<div class="row">
						<div class="col-md-12">
							<form name="editVolunteerForm" id="editVolunteerForm" class="form-horizontal well" ng-submit="updateVolunteer(editedVolunteer, editVolunteerForm.$valid);" ng-show="isEditing" novalidate>
								<h2>Edit Volunteer</h2>
								<hr />
								<div class="form-group" ng-class="{ 'has-error': editVolunteerForm.editVolunteer.$touched && editVolunteerForm.editVolunteer.$invalid }">
									<label class="control-label" for="volFirstName">Name</label>
									<div class="form-group-lg" ng-class="{ 'has-error' : editVolunteerForm.volFirstName.$touched && editVolunteerForm.volFirstName.$invalid }">
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
										<br />

										<!--last name-->
										<label class="control-label sr-only" for="volLastName">Last Name</label>
										<div class="input-group">
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
											</div>
										<input type="text" class="form-control" id="volLastName" name="volLastName" placeholder="Last Name" ng-model="editedVolunteer.volLastName" ng-required="true">
										</div>
										<div class="alert alert-danger" role="alert" ng-messages="editVolunteerForm.volLastName.$error" ng-if="editVolunteerForm.volLastName.$touched" ng-hide="editVolunteerForm.volLastName.$valid">
											<p ng-message="required">Please enter a last name</p>
										</div>
									</div>
									<br />
									<!--contact info-->
									<label class="control-label" for="volvolEmail">Contact</label>
									<div class="form-group-lg" ng-class="{ 'has-error': editVolunteerForm.volEmail.$touched && editVolunteerForm.volEmail.$invalid }">
										<!--volEmail-->
										<label class="control-label sr-only" for="volEmail">volEmail</label>
										<div class="input-group">
											<div class="input-group-addon">
												<span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>
											</div>
											<input type="email" class="form-control" id="volEmail" name="volEmail" placeholder="Email" ng-model="editedVolunteer.volEmail" ng-required="true" />
										</div>
										<div class="alert alert-danger" role="alert" ng-messages="editVolunteerForm.volEmail.$error" ng-if="editVolunteerForm.volEmail.$touched" ng-hide="editVolunteerForm.volEmail.$valid">
											<p ng-message="email">Email is invalid.</p>
											<p ng-message="required">Please enter an Email.</p>
										</div>
										<br />
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
								</div>
									<br />
								<button type="submit" class="btn btn-info btn-lg" ng-disabled="editVolunteerForm.$invalid"><i class="fa fa-share"></i> Volunteer</button>
								<button type="reset" class="btn btn-warning btn-lg" ng-click="cancelEditing();"><i class="fa fa-ban"></i> Cancel</button>
							</div>
							</form>
						</div>
					</div>
					</div>





					<!--Volunteer Table-->
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<uib-alert ng-repeat="alert in alerts" type="{{ alert.type }}" close="alerts.length = 0;">{{ alert.msg }}</uib-alert>
							<table class="table table-striped table-hover table-condensed">
								<thead>
									<th>First Name</th>
									<th>Last Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Actions</th>
								</thead>
								<tr class="info" ng-repeat="volunteer in volunteers">
									<td>{{ volunteer.volFirstName }}</td>
									<td>{{ volunteer.volLastName }}</td>
									<td>{{ volunteer.volEmail }}</td>
									<td>{{ volunteer.volPhone }}</td>
									<td>
										<button class="btn btn-info" ng-click="setEditedVolunteer(volunteer);"><i class="fa fa-pencil"></i></button>
										<form class="inline" ng-submit="deleteVolunteer(volunteer.volId);">
											<button type="submit" class="btn btn-danger"><i class="fa fa-trash"></i></button>
										</form>
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>