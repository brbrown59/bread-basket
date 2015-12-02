<?php
/**
 * Get the relative path.
 * @see https://raw.githubusercontent.com/kingscreations/farm-to-you/master/php/lib/_header.php FarmToYou Header
 **/

// include the appropriate number of dirname() functions
// on line 8 to correctly resolve your directory's path
require_once(dirname(dirname(__DIR__)) . "/root-path.php");
$CURRENT_DEPTH = substr_count($CURRENT_DIR, "/");
$ROOT_DEPTH = substr_count($ROOT_PATH, "/");
$DEPTH_DIFFERENCE = $CURRENT_DEPTH - $ROOT_DEPTH;
$PREFIX = str_repeat("../", $DEPTH_DIFFERENCE);


require_once($PREFIX . "php/lib/xsrf.php");
//start the session and create a XSRF token
if(session_status() !== PHP_SESSION_ACTIVE) {
	session_start();
}
setXsrfCookie();
?>
<!--current utilities for each page-->
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
		<script type="text/javascript" src="../../js/controllers/signin-modal.js"></script>
		<script type="text/javascript" src="../../js/controllers/newvolunteer-modal.js"></script>
		<script type="text/javascript" src="../../js/controllers/newlisting-modal.js"></script>
		<script type="text/javascript" src="../../js/controllers/contact-modal.js"></script>
		<script type="text/javascript" src="../../js/controllers/signup-controller.js"></script>
		<script type="text/javascript" src="../../js/controllers/signin-controller.js"></script>
		<script type="text/javascript" src="../../js/controllers/newvolunteer-controller.js"></script>
		<script type="text/javascript" src="../../js/controllers/newlisting-controller.js"></script>
		<script type="text/javascript" src="../../js/controllers/contact-controller.js"></script>

		<!--Page Title-->
		<title><?php echo $PAGE_TITLE; ?></title>

		<!-- Google Analytics -->
		<script>
			(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
						(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new
							Date();a=s.createElement(o),
					m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
			})(window,document,'script','//www.google-analytics.com/analytics.js','ga');
			ga('create', 'UA-64861502-1', 'auto');
			ga('send', 'pageview');
		</script>
	</head>
		<body>



