<form class="form-horizontal well" id="volunteerForm" name="volunteerForm">
	<h2>Create New Volunteer</h2>
	<hr/>
	<!--begin new volunteer-->
	<!--first name-->
	<div class="form-inline" ng-class="{ 'has-error' : volunteerForm.firstname.$touched && volunteerForm.firstname.$invalid }">
		<label class="control-label" for="firstname">First Name</label>
		<div class="input-group">
			<div class="input-group-addon">
				<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
			</div>
			<input type="text" class="form-control" id="firstname" name="firstname" placeholder="First Name" ng-model="volData.firstname" ng-required="true">
		</div>
		<div class="alert alert-danger" role="alert" ng-messages="volunteerForm.firstname.$error" ng-if="volunteerForm.firstname.$touched" ng-hide="volunteerForm.firstname.$valid">
			<p ng-message="required">Please enter a first name</p>
		</div>
	</div>
</form>