app.controller("ContactController", ["$scope", "$uibModal", function($scope, $uibModal) {
	$scope.contactData = {};

	$scope.openContactModal = function () {
		var ContactModalInstance = $uibModal.open({
			templateUrl: "../../js/views/contact-modal.php",
			controller: "ContactModal",
			resolve: {
				contactData : function () {
					return($scope.contactData);
				}
			}
		});
	}
}]);