<div class="modal-header">
	<h2>Post New Listing</h2>
</div>

<div class="modal-body">
	<form id="listingForm" name="listingForm" ng-submit="createListing(listing, listingForm.$valid);" ng-hide="isEditing">
		<p>Please include a pickup time and approximate size of donation in description. <br> Thank you for donating!</p>
		<!--begin new listing-->
		<!--memo-->
		<div class="form-group form-group-lg"
			  ng-class="{ 'has-error' : listingForm.memo.$touched && listingForm.memo.$invalid }">
			<label class="control-label" for="memo">Description</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</div>
				<textarea class="form-control" id="memo" name="memo" placeholder="Please add a brief description of your donation" ng-model="listingData.listingMemo" ng-required="true"></textarea>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="listingForm.listingMemo.$error" ng-if="listingForm.listingMemo.$touched" ng-hide="listingForm.listingMemo.$valid">
				<p ng-message="required">Please add a description</p>
			</div>
		</div>
		<!--cost and type-->
			<div class="form-group form-group-lg"
				  ng-class="{ 'has-error' : listingForm.listingCost.$touched && listingForm.listingCost.$invalid }">
				<label class="control-label" for="listingCost">Estimated Cost</label>
				<div class="input-group">
					<div class="input-group-addon">
						<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
					</div>
					<input type="number"
							 class="form-control"
							 id="listingCost" name="listingCost" placeholder="Estimated cost of donation" min=".01" step="1.00" ng-min=".01" ng-model="listingData.listingCost"  ng-init="listingData.listingCost=0.01" value=0.01
							 ng-required="true"/>
				</div>
				<div class="alert alert-danger"
					  role="alert"
					  ng-messages="listingForm.listingCost.$error"
					  ng-if="listingForm.listingCost.$touched"
					  ng-show="listingForm.listingCost.$invalid">
					<p ng-message="required">Please add an estimated cost.</p>
					<p ng-message="min">A value of at least .01 is required.</p>
				</div>
			</div>
			<!--type-->
			<div class="radio" ng-class="{ 'has-error' : listingForm.type1.$touched && listingForm.type1.$invalid }">
				<label class="control-label" for="type1">
					<input type="radio" name="listingTypeId" id="perishable" value="1" ng-model="listingData.listingTypeId">
					Perishable
				</label>
			</div>
			<div class="radio" ng-class="{ 'has-error' : listingForm.type2.$touched && listingForm.type2.$invalid }">
				<label class="control-label" for="type2">
					<input type="radio" name="listingTypeId" id="nonPerishable" value="2" ng-model="listingData.listingTypeId" ng-required="true">
					Non-Perishable
				</label>
			</div>
		<div class="alert alert-info"
			  role="alert"
			  ng-messages="listingForm.listingTypeId.$error"
			  ng-show="listingForm.listingTypeId.$invalid">
			<p ng-message="required">Please choose one of the types above.</p>
		</div>
	</div>

<div class="modal-footer">
	<button type="submit" class="btn btn-primary" ng-click="ok();" ng-disabled="listingForm.$invalid"><i class="fa fa-check" aria-hidden="true"></i>Submit</button>
	<button type="reset" class="btn btn-warning" ng-click="cancel();"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
	</form>
</div>