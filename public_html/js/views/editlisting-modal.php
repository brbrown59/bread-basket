<div class="modal-header">
	<h3 class="modal-title">Edit Listing</h3>
</div>
<div class="modal-body">
	<form id="editListingForm" name="editListingForm"  ng-submit="updateListing(editedListing, editListingForm.$valid);" ng-hide="isEditing">
		<h4>Posted On: 11/11/15</h4>
		<!--begin edit listing-->
		<!--memo-->
		<div class="form-group form-group-lg" ng-class="{ 'has-error' : editListingForm.memo.$touched && editListingForm.memo.$invalid }">
			<label class="control-label" for="memo">Description</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
				</div>
				<textarea class="form-control" id="memo" name="memo" placeholder="Please add a brief description of your donation" ng-model="listingData.listingMemo" ng-required="true"></textarea>
			</div>
			<div class="alert alert-danger" role="alert" ng-messages="editListingForm.listingMemo.$error" ng-if="editListingForm.listingMemo.$touched" ng-hide="editListingForm.listingMemo.$valid">
				<p ng-message="required">Please add a description</p>
			</div>
		</div>
		<!--cost and type-->
		<div class="form-group form-group-lg" ng-class="{ 'has-error' : editListingForm.listingCost.$touched && editListingForm.listingCost.$invalid }">
			<label class="control-label" for="cost">Estimated Cost</label>
			<div class="input-group">
				<div class="input-group-addon">
					<span class="glyphicon glyphicon-usd" aria-hidden="true"></span>
				</div>
				<input type="number" class="form-control" id="cost" name="cost" placeholder="Estimated cost of donation" min="0" step="0.01" ng-min="0" ng-model="listingData.listingCost" ng-required="false"/>
			</div>
		</div>
		<!--type-->
		<div class="radio" ng-class="{ 'has-error' : editListingForm.type1.$touched && editListingForm.type1.$invalid }">
			<label class="control-label" for="type1">
				<input type="radio" name="listingTypeId" id="perishable" value="93" ng-model="listingData.listingTypeId">
				Perishable
			</label>
		</div>
		<div class="radio" ng-class="{ 'has-error' : editListingForm.type2.$touched && editListingForm.type2.$invalid }">
			<label class="control-label" for="type2">
				<input type="radio" name="listingTypeId" id="nonPerishable" value="94" ng-model="listingData.listingTypeId">
				Non-Perishable
			</label>
		</div>
			<button type="submit" class="btn btn-lg btn-info" ng-click="ok();" ng-disabled="editListingForm.$invalid"><i class="fa fa-check" aria-hidden="true"></i>Submit</button>
			<button type="reset" class="btn btn-lg btn-warning" ng-click="cancel();"><i class="fa fa-ban" aria-hidden="true"></i> Cancel</button>
	</form>
</div>
</div>