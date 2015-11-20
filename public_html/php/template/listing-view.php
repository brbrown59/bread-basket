
<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Listings";
/*load head-utilss*/
require_once("utilities.php");

/*require once the header*/
require_once("header.php");

?>

<!-- HTML/PAGE CONTENT GOES HERE -->
<!--main content-->
<main>
	<!--this container houses the h1 tag/headline and the back to listing button-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>All Listings</h1>
			</div>
		</div>
	</div>
	<hr />
	<!--starts buttons-->
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<button class="btn btn-default btn-lg">Back</button>
			</div>
			<div class="col-xs-3" ng-controller="NewListingController">
				<button class="btn btn-info btn-lg" ng-click="openListingModal();">New Listing</button>
			</div>
		</div>
	</div>
	<hr />
	<!--starts table-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-striped table-hover">
					<thead>
						<th>Location</h3></th>
						<th>Description</th>
						<th>Date Posted</th>
						<th>Actions</th>
					</thead>
					<tr class="success">
						<td>Hippy Grocery</td>
						<td>Grapefruits! So many grapefruits!</td>
						<td>11/11/22 14:25</td>
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