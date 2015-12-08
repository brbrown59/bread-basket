
<!-- HTML/PAGE CONTENT GOES HERE -->
<!--main content-->

	<!--this container houses the h1 tag/headline and the back to listing button-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>My Organization</h1>
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
				<button class="btn btn-danger btn-lg">Delete</button>
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
					<h3>555 044 4553</h3>
				</div>
			</div>
			<div class="col-md-3">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-time"></span> Hours</h3>
					<h3>9am-5pm</h3>
				</div>
			</div>
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-home"></span> Address</h3>
					<address>
						<strong>Hippy Grocery</strong><br>
						123 Street NE<br>
						Albuquerque<br>
						NM<br>
						87106<br>
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
					<p>Shields up. I recommend we transfer power to phasers and arm the photon torpedoes. Something strange on the detector circuit.
						The weapons must have disrupted our communicators. You saw something as tasty as meat, but inorganically materialized out of
						patterns used by our transporters. Captain, the most elementary and valuable statement in science, the beginning of wisdom, is
						'I do not know.' All transporters off.
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

