<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8"/>
		<meta http-equiv="x-ua-compatible" content="IE=edge"/>
		<meta name="viewport" content="width=device-width, initial-scale=1"/>

		<title>Listing Details</title>

		<!--latest compiled and minified bootstrap css files-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">
		<!--optional theme-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap-theme.min.css" integrity="sha384-aUGj/X2zp5rLCbBxumKTCw2Z50WgIr1vs/PFN4praOTvYXWlVyh2UtNUU0KAUhAX" crossorigin="anonymous">
		<!--bread basket custom stylesheets-->
		<link rel="stylesheet" href="../../css/custom-style.css"/>

		<!--HTML5 shiv and Respond.js for IE8 support of HTML5 elements and media queries-->
		<!--WARNING: Respond.js doesn't work if you view the page via file://-->
		<!--[if lt IE 9]>
		<script src=//oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="//oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
		<![endif]-->
		<!--jQuery for Bootstrap's .js plugins-->
		<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
		<!--latest compiled and minified bootstrap javascript-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>
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
						<div class="col-md-12">
							<h1>Details</h1>
						</div>
					</div>
					<div class="row">
						<div class="col-md-12">
							<button type="button" class="btn btn-default">
								<a href="listing-view.php">
									<span class="glyphicon glyphicon-triangle-left"></span>
									All Listings
								</a>
							</button>
						</div>
					</div>
				</div>
				<hr>
				<!--this container houses the small details about the listing, perishable, datetime, open or closed, and esitmated cost-->
				<div class="container">
					<div class="row">
						<div class="col-md-3">
							<div class="text-box">
								<h3><span class="glyphicon glyphicon-ok"></span> Open</h3>
							</div>
						</div>
						<div class="col-md-3">
							<div class="text-box">
								<h3><span class="glyphicon glyphicon-list-alt"></span> Perishable</h3>
							</div>
						</div>
						<div class="col-md-3">
							<div class="text-box">
								<h3><span class="glyphicon glyphicon-calendar"></span> 11/11/22 14:45</h3>
							</div>
						</div>
						<div class="col-md-3">
							<div class="text-box">
								<h3><span class="glyphicon glyphicon-usd"></span> 1,000,000,000</h3>
							</div>
						</div>
					</div>
				</div>
				<!--this container houses the memo and organization information-->
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="text-box">
								<h3><span class="glyphicon glyphicon-send"></span> Memo</h3>
								<p>MEMO TEXT Offal ethical tacos, iPhone migas neutra vice yr freegan green juice williamsburg bicycle rights cardigan pork belly.
									Retro poutine irony chartreuse craft beer you probably haven't heard of them. Polaroid vice chicharrones, whatever tacos PBR&B
									umami single-origin coffee gluten-free mixtape portland. Readymade vegan pop-up, pug scenester hammock 8-bit flexitarian master cleanse.
								</p>
							</div>
						</div>
						<div class="col-md-6">
							<div class="text-box">
								<h3><span class="glyphicon glyphicon-home"></span> Hippy Grocery</h3>
								<div class="col-md-4">
									<h5>Address</h5>
									<p>123 Street NE</p>
									<p>Albuquerque</p>
									<p>NM</p>
									<p>87106</p>
								</div>
								<div class="col-md-4">
									<h5>Contact</h5>
									<p>Kathryn Janeway</p>
									<p>(505) 333-4444 ext. 555</p>
								</div>
								<div class="col-md-4">
									<h5>Hours</h5>
									<p>9am-5pm</p>
								</div>
							</div>
						</div>
					</div>
				</div>
				<!--this container houses the picture and google api location-->
				<div class="container">
					<div class="row">
						<div class="col-md-6">
							<div class="text-box">
								<h3><span class="glyphicon glyphicon-picture"></span> Picture</h3>
								<img class="img-responsive" src="../../img/grapefruit.jpg" alt="picture of donation"/>
							</div>
						</div>
						<div class="col-md-6">
							<div class="text-box">
								<h3><span class="glyphicon glyphicon-pushpin"></span> Location</h3>
								<img class="img-responsive" src="../../img/map-placeholder.png" alt="picture of donation"/>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
					<div class="row row-padding">
						<div class="col-sm-6 text-center">
							<button class="btn btn-success btn-lg ">Claim Listing</button>
						</div>
						<div class="col-sm-6 text-center">
							<button class="btn btn-danger btn-lg ">Cancel Claim</button>
						</div>
					</div>
				</div>

			</main>
			<!--footer-->
			<footer>
				<div class="container-fluid">
					<div class="row">
						<div class="col-md-12">
							IMMA FOOTER
						</div>
					</div>
				</div>
			</footer>
		</div>


	</body>
</html>