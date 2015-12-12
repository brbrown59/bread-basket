<div class="modal-header">
	<h3 class="modal-title">Details</h3>
	<h4>Posted On: 11/11/15</h4>
</div>
<div class="modal-body">
	<h4>{{ listing.listingType }} </h4>
	<h4>Description</h4>
	<p>{{ listing.listingMemo }}</p>
	<h4>Location</h4>
	<span>123 Street NE</span> <span>Albuquerque</span> <span>NM</span> <span>87106</span>
	<h4>Hours</h4>
	<span>9am-5pm</span>
	<h4>Contact Provider</h4>
	<span>505-867-5309</span>
</div>
<div class="modal-footer">
	<button class="btn btn-lg btn-info" type="button" ng-click="ok()">Claim Listing</button>
	<button class="btn btn-lg btn-warning" type="button" ng-click="cancel()">Cancel Claim</button>
</div>