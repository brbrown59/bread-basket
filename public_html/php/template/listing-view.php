
<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Listings";
/*load head-utils.php*/
require_once("utilities.php");
?>

<!-- HTML/PAGE CONTENT GOES HERE -->

	<body class="sfooter">
		<div class="sfooter-content">
			<header>
				<div class="container-fluid">
					<!--begin navbar-->
					<nav class="nav navbar-default">
						<!--logo and mobile toggle button get grouped together-->
						<div class="navbar-header">
							<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar" aria-expanded="false">
								<span class="sr-only">Main Menu</span>
								<span class="glyphicon glyphicon-th-large"></span>
							</button>
							<a href="#" class="navbar-brand">
								<span class="glyphicon glyphicon-grain"></span>
								Bread Basket
							</a>
						</div>

						<!--nav links are grouped together here-->
						<div class="collapse navbar-collapse navbar-right" id="my-navbar">
							<ul class="nav navbar-nav">
								<li><a href="#">Home</a></li>
								<li><a href="#">Listings</a></li>
								<li><a href="#">Profile</a></li>
								<li><a href="#">Volunteers</a> </li>
								<li><a href="#">Help</a></li>
							</ul>
						</div>
					</nav>
				</div>
			</header>
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