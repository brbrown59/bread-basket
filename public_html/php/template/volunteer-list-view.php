<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Volunteers";
/*load head-utilss*/
require_once("utilities.php");

/*require once the header*/
require_once("header.php");

?>
			<!--main content-->
			<main>
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
						<div class="col-xs-3" ng-controller="NewVolunteerController">
							<button class="btn btn-info btn-lg" ng-click="openVolunteerModal();">New Volunteer</button>
						</div>
					</div>
				</div>
				<hr />
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped table-hover table-condensed">
								<thead>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
									<th>Actions</th>
								</thead>
								<tr class="info">
									<td>Kathryn Janeway</td>
									<td>captain@voyager.com</td>
									<td>(505) 867-5309</td>
									<td>
										<button class="btn btn-info" ng-click="setEditedVolunteer(volunteer);"><i class="fa fa-pencil"></i></button>
										<form class="inline" ng-submit="deleteVolunteer(volunteer.volunteerId);">
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