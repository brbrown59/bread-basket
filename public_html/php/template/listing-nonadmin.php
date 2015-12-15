<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Listings Available";
/*load head-utils*/
require_once("utilities.php");

?>

<!--START NON ADMIN HEADER-->

<div class="na-header">

	<nav class="home-nav nav navbar">
		<!--logo and mobile toggle button get grouped together-->
		<div class="navbar-header">
			<button class="na-nav navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar" aria-expanded="false">
				<span class="sr-only">Main Menu</span>
				<span class="fa fa-bars"></span>
			</button>
			<div class="nav navbar-brand">
				<a href="#">
					<span class="glyphicon glyphicon-grain"></span>
					Bread Basket
				</a>
			</div>
		</div>

		<!--nav links are grouped together here-->
		<div class="collapse navbar-collapse navbar-right" id="my-navbar">
			<ul class="home-nav nav navbar-nav">
				<li ng-controller="SignoutController" ng-click="signOut();"><a href="#">Logout</a></li>
				<li ng-controller="ContactController" ng-click ="openContactModal();"><a href="#">Help</a></li>
			</ul>
		</div>
	</nav>

</div>

<!-- main content ---->
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