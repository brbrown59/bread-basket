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
						<div class="col-md-4">
							<h1 class="inline">All Volunteers</h1>
						</div>
						<div class="col-md-8" ng-controller="NewVolunteerController">
							<button class="btn btn-info" ng-click="openVolunteerModal();">New Volunteer</button>
						</div>
					</div>
				</div>
				<hr>
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-striped table-hover table-condensed">
								<thead>
									<th>Name</th>
									<th>Email</th>
									<th>Phone</th>
								</thead>
								<tr class="info">
									<td>Kathryn Janeway</td>
									<td>captain@voyager.com</td>
									<td>(505) 867-5309</td>
								</tr>
							</table>
						</div>
					</div>
				</div>
			</main>
		</div>
	</body>
</html>