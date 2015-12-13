<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Volunteers";
/*load head-utils*/
require_once("nav-utils.php");

?>

<header>

	<button class="btn btn-menu pull-right toggle-menu menu-right push-body">
		<i class="fa fa-bars"></i>
	</button>

	<!-- Right menu element-->
	<nav class="cbp-spmenu cbp-spmenu-vertical cbp-spmenu-right">
		<h3>Menu</h3>
		<a href="#">Celery seakale</a>
		<a href="#">Dulse daikon</a>
		<a href="#">Zucchini garlic</a>
		<a href="#">Catsear azuki bean</a>
		<a href="#">Dandelion bunya</a>
		<a href="#">Rutabaga</a>
	</nav>
</header>

<div class="volunteers-bg sfooter-content">
	<!--main content--->
	<main>


		<!--this container houses the h1 tag/headline and the back to listing button-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h2>All Volunteers</h2>
				</div>
				<div class="col-sm-6">
					<button class="btn btn-info btn-pull-right" ng-click="openVolunteerModal();">New Volunteer</button>
				</div>
			</div>
		</div>
		<hr />
		<!--Volunteer Table-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-md-12">
					<uib-alert ng-repeat="alert in alerts" type="{{ alert.type }}" close="alerts.length = 0;">{{ alert.msg }}</uib-alert>
					<table class="table table-responsive table-hover table-condensed">
						<thead class="table-style">
							<th>First Name</th>
							<th>Last Name</th>
							<th>Email</th>
							<th>Phone</th>
							<th>Actions</th>
						</thead>
						<tr class="table-style" ">
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