<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All listings Available";
/*load head-utils*/
require_once("utilities.php");

/*require once the header*/
require_once("header.php");

?>

<!-- main content --->
<div class="list-bg sfooter-content">
<main ng-controller="ListingController">
	<!---this container houes the h1 tag/headline and the back to listing button---->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<div class="h2-bb">Available Listings</div>
			</div>
		</div>
	</div>
	<hr class="media-hide" />

	<!-----starts table------>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<uib-alert ng-repeat="alert in alerts" type="{{ alert.type }}" close="alerts.length = 0;">{{ alert.msg}}</uib-alert>
				<table class="table table-condensed table-hover">
					<thead class="table-style">
						<th>Description</th>
						<th>Date Posted</th>
						<th>Details</th>
					</thead>
						<tr class="table-style" ng-repeat="listing in listings | orderBy:'-listingPostTime'">
							<td>{{ listing.listingMemo }}</td>
							<td>{{ listing.listingPostTime | date : 'short' }}</td>
							<td>
								<button class="btn btn-info btn-block" ng-hide="listing.listingClaimedBy" ng-click="setClaimedListing(listing, listings.indexOf(listing));">View</button>
								<button class="btn btn-warning btn-block" ng-show="listing.listingClaimedBy" ng-click="unclaimListing(listing, listings.indexOf(listing));">Claimed</button>
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
