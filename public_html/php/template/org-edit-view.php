<!-- HTML/PAGE CONTENT GOES HERE -->
<!--main content-->

<form id="organizationForm" name="organizationForm">
	<!--this container houses the h1 tag/headline and the back to listing button-->
	<div class="container">
		<div class="row">
			<div class="col-md-12">
				<h1>{{ organization.orgName }}</h1>
			</div>
		</div>
	</div>
	<hr/>
	<div class="container form-group" ng-class="{ 'has-error' : userForm.name.$invalid && !userForm.name.$pristine }">
		<div class="row">
			<div class="col-xs-3">
				<a class="btn btn-default btn-lg" href="login-landing-page.php" role="button">Back</a>
			</div>
			<div class="col-xs-3">
				<button type="submit" class="btn btn-info btn-lg" ng-click="updateOrganization(organization, organizationForm.$valid);">Submit</button>
			</div>
			<div class="col-xs-3">
				<button class="btn btn-danger btn-lg" ng-click="cancelEditing();">Cancel</button>
			</div>
		</div>
	</div>
	<hr/>
	<!--hours, phone, org description-->
	<div class="container form-group " ng-class="{ 'has-error' : organizationForm.orgPhone.$invalid && !organizationForm.orgPhone.$pristine }">
		<div class="row">
			<div class="col-md-3">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-phone"></span> Phone</h3>
				</div>
				<input class="form-group-lg well" type="text" id="orgPhone" name="orgPhone" ng-model="organization.orgPhone" placeholder="{{ organization.orgPhone }}" required>
				<div class="alert alert-danger" role="alert" ng-messages="organizationForm.orgPhone.$error" ng-if="organizationForm.orgPhone.$touched" ng-hide="organizationForm.orgPhone.$valid">
					<p ng-message="required">Please enter a phone number</p>
				</div>
			</div>
			<div class="col-md-3">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-time"></span> Hours</h3>
				</div>
				<input class="form-group form-group-lg well" type="text" id="orgHours" name="orgHours" ng-model="organization.orgHours" placeholder="{{ organization.orgHours }}">
			</div>
			<div class="col-md-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-home"></span> Address</h3>
					<input class="form-group form-group-lg well" type="text" id="orgAddress1" name="orgAddress1" ng-model="organization.orgAddress1" placeholder="{{ organization.orgAddress1 }}" required>
					<div class="alert alert-danger" role="alert" ng-messages="organization.orgAddress1.$error" ng-if="organization.orgAddress1.$touched" ng-hide="organization.orgAddress1.$valid">
						<p ng-message="required">Please enter an address</p>
					</div>
					<input class="form-group form-group-lg well" type="text" id="orgAddress2" name="orgAddress2" ng-model="organization.orgAddress2" placeholder="{{ organization.orgAddress2 }}">
					<input class="form-group form-group-lg well" type="text" id="orgCity" name="orgCity" ng-model="organization.orgCity" placeholder="{{ organization.orgCity }}" required>
					<input class="form-group form-group-lg well" type="text" id="orgState" name="orgState" ng-model="organization.orgState" placeholder="{{ organization.orgState }}" required>
					<input class="form-group form-group-lg well" type="text" id="orgZip" name="orgZip" ng-model="organization.orgZip" placeholder="{{ organization.orgZip }}" required>
					<div class="alert alert-danger" role="alert" ng-messages="organization.orgZip.$error" ng-if="organization.orgZip.$touched" ng-hide="organizationForm.orgPhone.$valid">
						<p ng-message="required">Please enter a zip</p>
						</div>
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
					<textarea class="form-control form-group form-group-lg well" id="orgDescription" name="orgDescription" ng-model="organization.orgDescription" maxlength="256"
								 placeholder="{{ organization.orgDescription }}"></textarea>
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