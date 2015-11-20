
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
			<div class="col-md-12" ng-controller="NewListingController">
				<h1 class="inline">All Listings</h1>
				<button class="btn btn-info pull-right" ng-click="openListingModal();">New Listing</button>
			</div>
		</div>
	</div>
	<hr>
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<table class="table table-condensed table-striped table-hover">
					<thead>
						<th>Location</h3></th>
						<th>Description</th>
						<th>Date Posted</th>
					</thead>
					<tr class="success">
						<td>Hippy Grocery</td>
						<td>Grapefruits! So many grapefruits!</td>
						<td>11/11/22 14:25</td>
					</tr>

				</table>
			</div>
		</div>
	</div>

</main>
</div>
</body>
</html>