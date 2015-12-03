app.controller("AlertController", ["$scope", "AlertService", function($scope, AlertService) {
	$scope.alerts = AlertService.getAlerts();

	$scope.closeAlert = function() {
		AlertService.closeAlert();
	};

	$scope.$on("alerts", function(event, alerts) {
		$scope.alerts = alerts;
	});
}]);