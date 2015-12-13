
<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Listings";
/*load head-utils*/
require_once("utilities.php");

/*require once the header*/
require_once("header.php");

?>

<!-- HTML/PAGE CONTENT GOES HERE -->
<!--main content-->
<main ng-controller="ListingController">
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
				<a class="btn btn-default btn-lg" href="login-landing-page.php" role="button">Back</a>
			</div>
			<div class="col-xs-3">
				<button class="btn btn-info btn-lg" ng-click="openListingModal();">New Listing</button>
			</div>
		</div>
	</div>
	<hr />
	<!--starts table-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<uib-alert ng-repeat="alert in alerts" type="{{ alert.type }}" close="alerts.length = 0;">{{ alert.msg }}</uib-alert>
				<table class="table table-condensed table-striped table-hover">
					<thead>
						<th>Location</th>
						<th>Description</th>
						<th>Date Posted</th>
						<th>Actions</th>
					</thead>
					<tr class="info" ng-repeat="listing in listings | orderBy:'-listingPostTime'">
						<td>Location</td>
						<td>{{ listing.listingMemo }}</td>
						<td>{{ listing.listingPostTime | date : format : timezone }}</td>
						<td>
							<button class="btn btn-info" ng-click="setEditedListing(listing, listings.indexOf(listing));"><i class="fa fa-pencil"></i></button>
							<form class="inline" ng-submit="deleteListing(listing.listingId, listings.indexOf(listing));">
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