<?php

require_once("prefix-utilities.php");

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

		<!--Google Fonts-->
		<link href='https://fonts.googleapis.com/css?family=Noto+Sans|Josefin+Sans' rel='stylesheet' type='text/css'>

		<!--Font Awesome-->
		<link type="text/css" rel="stylesheet" href="//maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css" />

		<!----------------------------CSS stylesheets-------------------------------------------->
		<!--latest compiled and minified Bootstrap css files-->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" integrity="sha512-dTfge/zgoMYpP7QbHy4gWMEGsbsdZeCXz7irItjcC3sPUFtf0kuFbDz/ixG7ArTxmDjLXDmezHubeNikyKGVyQ==" crossorigin="anonymous">

		<!-- CUSTOM stylesheets -->
		<link type="text/css" rel="stylesheet" href="<?php echo $PREFIX; ?>css/custom-style.css"/>
		<link rel="stylesheet" href="<?php echo $PREFIX; ?>css/nav.css" />

		<!----------------------------Javascript-------------------------------------------->

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script type="text/javascript" src="//ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
		<!--latest compiled and minified bootstrap javascript-->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js" integrity="sha512-K1qjQ+NcF2TYO/eI3M6v8EiNYZfA95pQumfvcVrTHtwQVDG+aHRqLi/ETn2uB+1JqwYqVG3LIvdm9lj6imS/pQ==" crossorigin="anonymous"></script>

		<!--NAVBAR-->
		<script src="<?php echo $PREFIX; ?>js/custom/nav.js"></script>

		<!--call jPushMenu, required-->
		<script>
			jQuery(document).ready(function($) {
				$('.toggle-menu').jPushMenu();
			});
		</script>

		<!-- ALL js files, including Angular, Pusher, and Custom JS files-->
		<?php require_once("js-utilities.php") ?>

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
	<body class="sfooter">



