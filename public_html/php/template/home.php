<?php

/**
* Angular version
**/
$ANGULAR_VERSION = "1.4.7";
?>

<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>
		<!-- CSS stylesheets -->
		<!--latest compiled and minified bootstrap css files-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
		<!--optional theme-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
		<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css" rel="stylesheet">
		<!--minified font awesome css-->
		<link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />
		<!-- CUSTOM stylesheets -->
		<link type="text/css" rel="stylesheet" href="../../css/custom-style.css"/>

		<!-- CDN derived JavaScript -->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs<?php echo $ANGULAR_VERSION; ?>/angular.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/<?php echo $ANGULAR_VERSION; ?>/angular-messages.min.js"></script>
		<script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/angular-ui-bootstrap/0.14.3/ui-bootstrap-tpls.min.js"></script>
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/angularjs/1.4.7/angular-animate.js"></script>

		<!-- CUSTOM js-->
		<script type="text/javascript" src="../../js/angular-ui-tabs.js"></script>

		<title>Bread Basket Home</title>

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
				<div class="bg-blue container-fluid">
					<div class="padding-block-lg">
						<div class="row">
							<div class="col-md-12 center-block home-block">
								<div class="text-center lead">
									Connecting People To End Hunger
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<button class="btn btn-lg">Find Out How</button>
							</div>
						</div>
					</div>
				</div>
				<div class="contianer-fluid">
					<div class="padding-block-sm">
						<div class="row">
							<div class="col-md-12 center-block">
								<div class="text-center lead">
									How It Works
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<div class="text-center">



								</div>


							</div>
						</div>
					</div>


				</div>

			</main>

		</div>
	</body>


</html>