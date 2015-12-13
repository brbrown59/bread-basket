app.controller("ListingModal", ["$scope", "$uibModalInstance", function($scope, $uibModalInstance) {
	$scope.listingData = {};
	//file name is funky, but don't change the code!!! claims are handled in listingdetail-modal.js
	$scope.ok = function() {
		$uibModalInstance.close($scope.listingData);
	};

	$scope.cancel = function() {
		$uibModalInstance.dismiss("cancel");
	};
}]);