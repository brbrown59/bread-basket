<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "Details";
/*load head-utilss*/
require_once("utilities.php");

/*require once the header*/
require_once("header.php");

?>

<main ng-controller="ListingController"><!--right?  SHOULDN'T need another controller...-->
	<div class="container">
		<listing-view ng-hide="isEditing"></listing-view>
		<listing-edit ng-show="isEditing"></listing-edit>
	</div>
</main>

</body>
</html>