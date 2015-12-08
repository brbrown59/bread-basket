<!-- HTML/PAGE CONTENT GOES HERE -->
<!--main content-->

	<form>
	<!--this container houses the h1 tag/headline and the back to listing button-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ organization.orgName }}</h1>
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
				<button class="btn btn-info btn-lg" ng-click="cancelEditing();">Submit</button>
			</div>
			<div class="col-xs-3">
				<button class="btn btn-danger btn-lg" ng-click="cancelEditing();">Cancel</button>
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
				<input class="form-group form-group-lg well" type="text" placeholder="{{ organization.orgPhone }}">
			</div>
			<div class="col-md-3">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-time"></span> Hours</h3>
				</div>
				<input class="form-group form-group-lg well" type="text" placeholder="{{ organization.orgHours }}">
			</div>
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-home"></span> Address</h3>
					<input class="form-group form-group-lg well" type="text" placeholder="{{ organization.orgAddress1 }}">
					<input class="form-group form-group-lg well" type="text" placeholder="{{ organization.orgAddress2 }}">
					<input class="form-group form-group-lg well" type="text" placeholder="{{ organization.orgCity }}">
					<input class="form-group form-group-lg well" type="text" placeholder="{{ organization.orgState }}">
					<input class="form-group form-group-lg well" type="text" placeholder="{{ organization.orgZip }}">
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
					<textarea class="form-control form-group form-group-lg well" maxlength="256" placeholder="{{ organization.orgDescription }}"></textarea>
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