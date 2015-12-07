app.controller("AlertController", ["$rootScope", "$scope", "AlertService", function($rootScope, $scope, AlertService) {
	$scope.alerts = AlertService.getAlerts();

	$scope.closeAlert = function() {
		AlertService.closeAlert();
	};

	$rootScope.$on("alerts", function(event, alerts) {
		console.log("RECEIVED BROADCAST HAIL");
		console.log(alerts);
		$scope.alerts = alerts;
	});
}]);