<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "Home";
/*load head-utils*/
require_once("utilities.php");

require_once("prefix-utilities.php");

?>

<script> console.log("-=^.^=- fuzzy kitty!"); </script>
<body class="sfooter">
	<div class="home-img sfooter-content">
		<div class="container-fluid">
			<!--begin navbar-->
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
						<li ng-controller="SigninController" ng-click="openSigninModal();"><a href="#">Login</a></li>
						<li ng-controller="SignupController" ng-click="openSignupModal();"><a href="#">Sign Up</a></li>
					</ul>
				</div>
			</nav>
		</div>
		<!--main content-->
		<main>
			<!--container 1-->
			<div class="container-fluid">
				<div class="padding-top-bottom-lg">
					<div class="row">
						<div class="col-lg-4 col-lg-offset-4">
							<div class="text-center">
								<h1>Connecting People To End Hunger</h1>
							</div>
						</div>
					</div>
					<div class="row">
						<div ng-controller="SignupController" class="col-md-4 col-md-offset-4 text-center">
							<button ng-click="openSignupModal();" class="btn btn-lg btn-home">Sign Up</a></button>
						</div>
					</div>
				</div>
			</div>
			<!--container 2-->
			<div class="bg-drk container-fluid">
				<div class="padding-top-bottom-sm">
					<div class="row">
						<div class="col-sm-4 col-sm-offset-4">
							<div class="text-center">
								<h1>How It Works</h1>
								<hr />
							</div>
						</div>
					</div>
					<!--HOW IT WORKS--->
					<div class="row">
						<div class="container">
							<div class="col-sm-6 col-sm-offset-2">
								<h1>Food Provider</h1>
								<div class="home-lead"> <span class="fa fa-pencil"></span> &nbsp;Create a New Listing</div>
								<div class="home-lead"> <span class="fa fa-circle-o-notch fa-spin"></span> &nbsp;Wait for a Volunteer to claim it</div>
								<div class="home-lead"> <span class="fa fa-heart"></span> &nbsp;Pass off the donation</div>

							</div>
							<div class="col-sm-4">
								<img class="img-responsive img-circle" src="<?php echo $PREFIX; ?>img/grocery.jpg" alt="food provider image" />
							</div>
						</div>
					</div>
					<div class="container"><hr /></div>
					<div class="row">
						<div class="container">
							<div class="col-sm-6 col-sm-offset-2">
								<h1>Food Receiver</h1>
								<div class="home-lead"><span class="fa fa-mobile"></span> &nbsp;View all Listings</div>
								<div class="home-lead"><span class="fa fa-thumbs-up"></span> &nbsp;Claim a Listing</div>
								<div class="home-lead"><span class="fa fa-car"></span> &nbsp;Pick up the Listing</div>
							</div>
							<div class="col-sm-4">
								<img class="img-responsive img-circle" src="<?php echo $PREFIX; ?>img/buffet2.jpg" alt="food provider image" />
							</div>
						</div>
					</div>
				</div>
			</div>

			<!--container 3-->
			<div class="container-fluid">
				<div class="padding-top-bottom-sm">
					<div class="row">
						<div class="col-md-4 col-md-offset-4">
							<div class="text-center">
								<h1>Learn More</h1>
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-4 col-md-offset-4 text-center">
							<div ng-controller="ContactController">
								<button class="btn btn-lg btn-home" ng-click="openContactModal();">Contact Us</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</main>

	</div>

	<?php require_once("footer.php")?>
</body>


</html>