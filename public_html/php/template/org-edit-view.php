<!-- HTML/PAGE CONTENT GOES HERE -->
<!--main content-->


<!--this container houses the h1 tag/headline and the back to listing button-->
<div class="container">
	<div class="row">
		<div class="col-sm-8">
			<div class="h2-bb">{{ organization.orgName }}</div>
		</div>

			<form id="organizationForm" name="organizationForm">
				<div class="form-group" ng-class="{ 'has-error' : organizationForm.$invalid && !organizationForm.$pristine }">
					<div class="row">
						<div class="col-sm-2">
							<button id= "btn-block" type="submit" class="btn btn-info btn-block" ng-disabled="organizationForm.$invalid"
									  ng-click="updateOrganization(organization, organizationForm.$valid);">Submit
							</button>
						</div>
						<div class="col-sm-2">
							<button id= "btn-block" class="btn btn-danger btn-block" ng-click="cancelEditing();">Cancel</button>
						</div>
					</div>
				</div>

<hr/>
	<!--Phone-->
		<div class="col-sm-3">
			<div class="form-group"
				  ng-class="{ 'has-error': organizationForm.orgPhone.$touched && organizationForm.orgPhone.$invalid }">
				<h3>
					<label for="orgPhone"><span class="glyphicon glyphicon-phone"></span> Phone</label>
				</h3>

				<div class="input-group">
					<input
						class="form-control"
						type="text" id="orgPhone"
						name="orgPhone"
						ng-model="organization.orgPhone"
						placeholder="Phone"
						ng-required="true"
						ng-minlength="7"
					/>
				</div>
				<div class="alert alert-danger"
					  role="alert"
					  ng-messages="organizationForm.orgPhone.$error"
					  ng-show="organizationForm.orgPhone.$invalid"
					  ng-class="{ 'has-error' : organization.orgPhone.$invalid }">
					<p ng-message="required">Please enter a phone number</p>
					<p ng-message="minlength">Phone number is too short</p>
				</div>
			</div>
		</div>
		<!--			Hours-->
		<div class="col-sm-3">
			<div class="form-group"
				  ng-class="{ 'has-error': organizationForm.orgPhone.$touched && organizationForm.orgPhone.$invalid }">
				<h3>
					<label for="orgHours"><span class="glyphicon glyphicon-time"></span> Hours</label>
				</h3>

				<div class="input-group">

					<input class="form-control"
							 type="text"
							 id="orgHours"
							 name="orgHours"
							 ng-model="organization.orgHours"
							 placeholder="Hours">
				</div>
			</div>
		</div>

		<!--address-->
		<div class="col-sm-6">
			<h3>
				<span class="glyphicon glyphicon-home"></span> Address
			</h3>

			<div class="form-inline">
				<div class="form-group"
					  ng-class="{ 'has-error': organizationForm.orgAddress1.$touched && organizationForm.orgAddress1.$invalid }">
					<label class="sr-only" for="orgAddress1">Address 1</label>

					<div class="input-group">
						<input class="form-control"
								 type="text"
								 id="orgAddress1"
								 name="orgAddress1"
								 ng-model="organization.orgAddress1"
								 placeholder="Address 1"
								 ng-required="true">
					</div>
					<div class="alert alert-danger"
						  role="alert"
						  ng-messages="organizationForm.orgAddress1.$error"
						  ng-show="organizationForm.orgAddress1.$invalid">
						<p ng-message="required">Address 1 is required</p>
					</div>
				</div>
				<div class="form-group"
					  ng-class="{ 'has-error': organizationForm.orgAddress2.$touched && organizationForm.orgAddress2.$invalid }">
					<label class="sr-only" for="orgAddress2">Address 2</label>

					<div class="input-group">
						<input class="form-control"
								 type="text"
								 id="orgAddress2"
								 name="orgAddress2"
								 ng-model="organization.orgAddress2"
								 placeholder="Address 2">
					</div>
				</div>
			</div>

			<div class="form-inline">
				<div class="form-group"
					  ng-class="{ 'has-error': organizationForm.orgCity.$touched && organizationForm.orgCity.$invalid }">
					<label class="sr-only" for="orgCity">City</label>

					<div class="input-group">
						<input class="form-control"
								 type="text"
								 id="orgCity"
								 name="orgCity"
								 ng-model="organization.orgCity"
								 placeholder="City"
								 ng-required="true">
					</div>
					<div class="alert alert-danger"
						  role="alert"
						  ng-messages="organizationForm.orgCity.$error"
						  ng-show="organizationForm.orgCity.$invalid">
						<p ng-message="required">City is required</p>
					</div>
				</div>
				<div class="form-group"
					  ng-class="{ 'has-error': organizationForm.orgState.$touched && organizationForm.orgState.$invalid }">
					<label class="sr-only" for="orgState">State</label>

					<div class="input-group">
						<input class="form-control"
								 type="text"
								 id="orgState"
								 name="orgState"
								 size="2"
								 maxlength="2"
								 ng-model="organization.orgState"
								 placeholder="State"
								 ng-required="true"
								 ng-maxlength="2">
					</div>
					<div class="alert alert-danger"
						  role="alert"
						  ng-messages="organizationForm.orgState.$error"
						  ng-show="organizationForm.orgState.$invalid">
						<p ng-message="required">State is required</p>
					</div>
				</div>
				<div class="form-group"
					  ng-class="{ 'has-error': organizationForm.orgZip.$touched && organizationForm.orgZip.$invalid }">
					<label class="sr-only" for="orgZip">Zip</label>

					<div class="input-group">
						<input class="form-control"
								 type="text"
								 id="orgZip"
								 name="orgZip"
								 size="10"
								 ng-model="organization.orgZip"
								 placeholder="Zip"
								 ng-required="true"
								 ng-maxlength="10">
					</div>
					<div class="alert alert-danger"
						  role="alert"
						  ng-messages="organizationForm.orgZip.$error"
						  ng-show="organizationForm.orgZip.$invalid">
						<p ng-message="required">Please enter a zip</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>


	<!--Description-->
	<div class="form-group form-group-lg">
		<div class="row">
			<div class="col-sm-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-pencil"></span> Description</h3>
					<textarea class="form-control" id="orgDescription" name="orgDescription"
								 ng-model="organization.orgDescription" maxlength="256"
								 placeholder="Description (Optional)"></textarea>
				</div>
			</div>
			<div class="col-sm-6">
				<div class="text-box">
					<h3><span class="glyphicon glyphicon-pushpin"></span> Location</h3>
					<img class="img-responsive" src="../../img/map-placeholder.png" alt="picture of donation"/>
				</div>
			</div>
		</div>
	</div>
</form>
</div>

</main>
</div>

</body>
</html>