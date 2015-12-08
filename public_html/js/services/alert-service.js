app.service("AlertService", function($rootScope, $timeout) {
	this.alerts = [];

	this.addAlert = function(alert) {
		console.log("BLUE ALERT: {type:" + alert.type + ", msg:" + alert.msg + "}");
		this.alerts[0] = alert;
			$rootScope.$broadcast("alerts", this.alerts);
		//$rootScope.$broadcast("alerts", this.alerts);
	};

	this.clearAlert = function() {
		this.alerts.length = 0;
			$rootScope.$broadcast("alerts", this.alerts);
		//$rootScope.$broadcast("alerts", this.alerts);
	};

	this.getAlerts = function() {
		return(this.alerts);
	};
});