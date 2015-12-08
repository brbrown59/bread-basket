app.controller("SignoutController", ["$scope", "SignoutService", function($scope, SignoutService){
	$scope.signOut = function() {
		SignoutService.signout();
	}
}]);