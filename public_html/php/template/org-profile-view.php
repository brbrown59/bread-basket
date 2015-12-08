
<!-- HTML/PAGE CONTENT GOES HERE -->
<!--main content-->

	<!--this container houses the h1 tag/headline and the back to listing button-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ organization.orgName }} </h1>
			</div>
		</div>
	</div>
	<hr />
	<div class="container">
		<div class="row">
			<div class="col-xs-3">
				<a class="btn btn-default btn-lg" href="login-landing-page.php" role="button">Back</a>
			</div>
			<div class="col-xs-3">
				<button class="btn btn-warning btn-lg" ng-click="setEditedOrganization();">Edit</button>
			</div>
			<div class="col-xs-3">
				<button class="btn btn-danger btn-lg" ng-click="deleteOrganization(orgId);">Delete</button><!--might need to handle this call differently; maybe through a directive-->
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
					<h3>{{ organization.orgPhone }}</h3>
				</div>
			</div>
			<div class="col-md-3">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-time"></span> Hours</h3>
					<h3>{{ organization.orgHours }}</h3>
				</div>
			</div>
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-home"></span> Address</h3>
					<address>
						<strong>{{ organization.orgName }}</strong><br>
						{{ organization.orgAddress1 }}<br>
						{{ organization.orgAddress2 }}<br>
						{{ organization.orgCity }}
						{{ organization.orgState }}<br>
						{{ organization.orgZip }}<br>
					</address>
				</div>
			</div>
		</div>
	</div>
	<!--address-->
	<div class="container">
		<div class="row">
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-pencil"></span> Description</h3>
					<p>{{ organization.orgDescription }}
					</p>
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

