<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "My Organization";
/*load head-utilss*/
require_once(dirname(__DIR__) . "/utilities.php");

?>

<!-----------RECEIVER LANDING PAGE---------!>
<!--main html content-->
<div class="login-bg sfooter-content">
	<?php require_once(dirname(__DIR__) . "/header.php");?>
	<div class="container-fluid">
		<div class="jumbotron">
			<h1>Hello Again!</h1>
			<p>Get started by selecting a option below</p>
			<div class="row">
				<div class="col-md-4">
					<a class="btn btn-info btn-lg btn-block" href="org-base.php" role="button">My Organization</a>
				</div>
				<div class="col-md-4">
					<a class="btn btn-info btn-lg btn-block" href="listings-view.php" role="button">All Listings</a>
				</div>
				<div class="col-md-4" ng-controller="ContactController">
					<button class="btn btn-warning btn-lg btn-block" ng-click ="openContactModal();">Help</button>
				</div>
			</div>
		</div>
	</div>
</div>
</body>