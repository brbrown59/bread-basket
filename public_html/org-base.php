<?php
/*grab current directory*/
$CURRENT_DIR = __DIR__;
/*set page title here*/
$PAGE_TITLE = "My Organization";
/*load head-utils*/
require_once("utilities.php");

/*require once the header*/
require_once("header.php");

?>

<main class="list-bg sfooter-content" ng-controller="OrganizationController">
	<div class="container">
		<org-view ng-hide="isEditing"></org-view>
		<org-edit ng-show="isEditing"></org-edit>
	</div>
</main>

</body>
</html>
