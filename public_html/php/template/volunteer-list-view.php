<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Volunteers";
/*load head-utils*/
require_once("utilities.php");
require_once("header.php");

?>

<div class="list-bg sfooter-content">
			<!--main content-->
			<main ng-controller="VolunteerController">
				<!--this container houses the h1 tag/headline and the back to listing button-->
				<div class="container-fluid">
					<div class="row">
						<div class="col-sm-6">
							<div class="h2-bb">All Volunteers</div>
						</div>
						<div class="col-sm-6">
							<button class="btn btn-info btn-btn-right" ng-click="openVolunteerModal();">New Volunteer</button>
						</div>
					</div>
				</div>
				<hr  />
					<!--Volunteer Table-->
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							<uib-alert ng-repeat="alert in alerts" type="{{ alert.type }}" close="alerts.length = 0;">{{ alert.msg }}</uib-alert>
							<table class="table table-condensed table-hover">
								<thead class="table-style">
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Actions</th>
								</thead>
								<tr class="table-style" ng-repeat="volunteer in volunteers">
									<td>{{ volunteer.volFirstName }} {{ volunteer.volLastName }}</td>
									<td>{{ volunteer.volEmail }}</td>
									<td>{{ volunteer.volPhone }}</td>
									<td>
										<button class="btn btn-info" ng-click="setEditedVolunteer(volunteer, volunteers.indexOf(volunteer));"><i class="fa fa-pencil"></i></button>
										<form class="inline" ng-submit="deleteVolunteer(volunteer.volId, volunteers.indexOf(volunteer));">
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