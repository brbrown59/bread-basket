app.service("AlertService", function($rootScope) {
	this.alerts = [];

	this.addAlert = function(alert) {
		this.alerts[0] = alert;
		$rootScope.$broadcast("alerts", this.alerts);
	};

	this.clearAlert = function() {
		this.alerts.length = 0;
		$rootScope.$broadcast("alerts", this.alerts);
	};

	this.getAlerts = function() {
		return(this.alerts);
	};
});