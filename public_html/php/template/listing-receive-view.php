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


<!-- HTML/PAGE CONTENT GOES HERE -->
<!-- main content --->
<main ng-controller="ListingController">
	<!---this container houes the h1 tag/headline and the back to listing button---->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>Available Listings</h1>
			</div>
		</div>
	</div>
	<hr />

<!--	<!---starts buttons-->
<!--	<div class="container">-->
<!--		<div class="row">-->
<!--<!--			<div class="col-xs-3">-->
<!--<!--				<a class="btn btn-default btn-lg" href="login-landing-page.php" role="button"></a>-->
<!--<!--			</div>-->
<!---->
<!--			<!--------button for new listing-->
<!--			<div class="col-xs-3">-->
<!--				<button class="btn btn-info btn-lg" ng-click=""openListingModal();">text for button goes here</button>-->
<!--			</div>-->
<!--			---------->
<!---->
<!--		</div>-->
<!--	</div>-->
<!--	<hr />-->

	<!-----starts table------>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<uib-alert ng-repeat="alert in alerts" type="{{ alert.type }}" close="alerts.length = 0;">{{ alert.msg}}</uib-alert>
				<table class="table table-condensed table-striped table-hover">
					<thead>
						<th>Location</h3></th>
						<th>Description</th>
						<th>Date Posted</th>
						<th>Details</th>
					</thead>
						<tr class="info" ng-repeat="listing in listings | orderBy:'-listingPostTime'">
							<td>Filler</td>
							<td>{{ listing.listingMemo }}</td>
							<td>{{ listing.listingPostTime | date : 'medium' }}</td>
							<td>
								<button class="btn btn-info" ng-hide="listing.listingClaimedBy" ng-click="setClaimedListing(listing, listings.indexOf(listing));">Claim Listing</button>
								<button class="btn btn-danger" ng-show="listing.listingClaimedBy">Listing Claimed</button>
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
