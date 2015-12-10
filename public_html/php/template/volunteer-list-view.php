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
					</div>
				</div>
				<hr />
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