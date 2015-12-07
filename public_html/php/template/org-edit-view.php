<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "My Organization";
/*load head-utilss*/
require_once("utilities.php");

/*require once the header*/
require_once("header.php");

?>

<!-- HTML/PAGE CONTENT GOES HERE -->
<!--main content-->
<main>
	<form>
	<!--this container houses the h1 tag/headline and the back to listing button-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>My Organization</h1>
			</div>
		</div>
	</div>
	<hr />
	<div class="container form-group">
		<div class="row">
			<div class="col-xs-3">
				<a class="btn btn-default btn-lg" href="login-landing-page.php" role="button">Back</a>
			</div>
			<div class="col-xs-3">
				<button class="btn btn-info btn-lg">Submit</button>
			</div>
			<div class="col-xs-3">
				<button class="btn btn-danger btn-lg">Cancel</button>
			</div>
		</div>
	</div>
	<hr />
	<!--hours, phone, org description-->
	<div class="container">
		<div class="row">
			<div class="col-md-3">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-phone"></span> Phone</h3>
				</div>
				<input class="form-group form-group-lg well" type="text" placeholder="Phone">
			</div>
			<div class="col-md-3">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-time"></span> Hours</h3>
				</div>
				<input class="form-group form-group-lg well" type="text" placeholder="Hours">
			</div>
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-home"></span> Address</h3>
					<textarea class="form-control form-group form-group-lg well" ></textarea>
				</div>
			</div>
		</div>
	</div>
	<!--address-->
	<div class="container form-group form-group-lg">
		<div class="row">
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-pencil"></span> Description</h3>
					<textarea class="form-control form-group form-group-lg well" maxlength="256"></textarea>
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
	</form>

</main>
</div>

</body>
</html>