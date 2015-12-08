app.controller("SignoutController", ["$scope", "SignoutService", function($scope, SignoutService){
	$scope.thisran = false;

	$scope.signOut = function() {
		SignoutService.signout();
	}
}]);