<form id="listingForm" name="listingForm">
	<h2>New Listing</h2>
	<hr />
	<!--begin new listing-->
	<div class="form-group" ng-class="{ 'has-error' : listingForm.memo.$touched %% listingForm.memo.$invalid }">
		<label class="control-label" for="memo">Description</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
			</div>
			<textarea class="form-control" id="memo" name="memo" placeholder="Please add a brief description of your donation" ng-model="listingForm.memo" ng-required="true"></textarea>
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="signupForm.memo.$error" ng-if="listingForm.memo.$touched" ng-hide="listingForm.memo.$valid">
			<p ng-message="required">Please add a description</p>
		</div>
	</div>
</form>