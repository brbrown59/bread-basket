
<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All Listings";
/*load head-utils.php*/
require_once("utilities.php");
?>

<!-- HTML/PAGE CONTENT GOES HERE -->


<!DOCTYPE html>
<html lang="en" ng-app="BreadBasket">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<!-- CSS stylesheets -->
		<!--latest compiled and minified bootstrap css files-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
		<link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<!--optional theme-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<!--minified font awesome css-->
		<link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<!-- CUSTOM stylesheets -->
		<link type="text/css" rel="stylesheet" href="../../css/custom-style.css"/>

		<!--jQuery for Bootstrap's .js plugins-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!--latest compiled and minified bootstrap javascript-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

		<!--CDN derived Angular.js -->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.6/angular.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.6/angular-messages.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.3/ui-bootstrap-tpls.min.js"></script>

		<!-- CUSTOM js-->
		<script type="text/javascript" src="../../js/angular-password.min.js"></script>
		<script type="text/javascript" src="../../js/breadbasket.js"></script>
		<script type="text/javascript" src="../../js/controllers/tabs.js"></script>
		<script type="text/javascript" src="../../js/controllers/newlisting-modal.js"></script>
		<script type="text/javascript" src="../../js/controllers/newlisting-controller.js"></script>


		<title>All Listings</title>

	</head>
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