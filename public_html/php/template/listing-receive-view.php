<?php
/*grab current directory*/
$CURRENT_Dir = __DIR__;
/*set page title here*/
$PAGE_TITLE = "All listings Available";
/*load head-utilss*/
requier_once("utilities.php");

/*requier once the header*/
require_once("header.php");

?>


<!-- HTML/PAGE CONTENT GOES HERE -->
<!-- main content --->
<main ng-controller="ListingController">
	<!---this container houes the h1 tag/headline and the back to listing button---->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>ALL listings Avilable</h1>
			</div>
		</div>
	</div>

</main>

