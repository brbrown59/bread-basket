app.controller("SignoutController", ["$scope", "SignoutService", "$window", function($scope, SignoutService, $window){

	$scope.signOut = function() {
		SignoutService.signout();
		$window.location.assign("../../php/template/home.php")
	}
}]);