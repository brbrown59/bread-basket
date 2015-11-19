<?php

/**
* Angular version
**/
$ANGULAR_VERSION = "1.4.7";
?>

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
		<script type="text/javascript" src="../../js/controllers/signup-modal.js"></script>
		<script type="text/javascript" src="../../js/controllers/signup-controller.js"></script>
		<script type="text/javascript" src="../../js/controllers/signin-controller.js"></script>
		<script type="text/javascript" src="../../js/controllers/signin-modal.js"></script>



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
								<li ng-controller="SigninController" ng-click="openSigninModal();"><a href="#">Login</a></li>
								<li ng-controller="SignupController" ng-click="openSignupModal();"><a href="#">Sign Up</a></li>
							</ul>
						</div>
					</nav>
				</div>
			</header>
			<!--main content-->
			<main>
				<!--container 1-->
				<div class="bg-blue container-fluid">
					<div class="padding-top-bottom-lg">
						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<div class="text-center lead">
									Connecting People To End Hunger
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-md-offset-4 text-center">
								<button class="btn btn-lg">Find Out How</button>
							</div>
						</div>
					</div>
				</div>
				<!--container 2-->
				<div class="container-fluid">
					<div class="padding-top-bottom-sm">
						<div class="row">
							<div class="col-md-12 center-block">
								<div class="text-center lead">
									How It Works
								</div>
							</div>
						</div>
						<!--giver / receiver tabs-->
						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<div ng-controller="TabsController">
									<uib-tabset justified="true">
										<uib-tab ng-repeat="tab in tabs" heading="{{tab.title}}" >
											{{tab.content}}
										</uib-tab>
									</uib-tabset>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--container 3-->
				<div class="container-fluid bg-powderblue">
					<div class="padding-top-bottom-sm">
						<div class="row">
							<div class="col-md-4 col-md-offset-4">
								<div class="text-center lead">
									Join Us
								</div>
							</div>
						</div>
						<div class="row">
							<div class="col-md-4 col-md-offset-4 text-center">
								<div ng-controller="SignupController">
								<button class="btn btn-lg" ng-click="openSignupModal();">Sign Up</button>
								</div>
							</div>
						</div>
					</div>
				</div>
			</main>

		</div>
	</body>


</html>