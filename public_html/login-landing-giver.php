<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "Bread Basket Home";
/*load head-utilss*/
require_once("utilities.php");
require_once("giver-header.php")

?>

<!--main html content-->
<div class="login-bg sfooter-content">
	<div class="container-fluid">
		<div class="jumbotron">
			<div class="container">
				<h1>Hello Again!</h1>
				<p>Get started by selecting a option below</p>
				<div class="row">
					<div class="col-md-4">
						<a id= "btn-block" class="btn btn-info btn-lg btn-block" href="org-base-giver.php" role="button">My Organization</a>
					</div>
					<div class="col-md-4">
						<a id= "btn-block" class="btn btn-info btn-lg btn-block" href="listing-view.php" role="button">All Listings</a>
					</div>
					<div class="col-md-4" ng-controller="ContactController">
						<button id= "btn-block" class="btn btn-warning btn-lg btn-block" ng-click ="openContactModal();">Help</button>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</body>
