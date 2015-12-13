<header>
	<div class="container-fluid">
		<!--begin navbar-->
		<nav class="home-nav nav navbar">
			<!--logo and mobile toggle button get grouped together-->
			<div class="navbar-header">
				<button class="navbar-toggle collapsed" data-toggle="collapse" data-target="#my-navbar" aria-expanded="false">
					<span class="sr-only">Main Menu</span>
					<span class="glyphicon glyphicon-th-large"></span>
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
				<ul class="nav navbar-nav">
					<li><a href="login-landing-page.php">Home</a></li>
					<li><a href="org-base.php">Organization</a></li>
					<li><a href="listing-view.php">Listings</a></li>
					<li><a href="volunteer-list-view.php">Volunteers</a> </li>
					<li><a ng-controller="SignoutController" href="home.php" ng-click="signOut();">Sign Out</a></li>
					<li><a href="#">Help</a></li>
				</ul>
		</nav>
	</div>
</header>

