app.controller("TabsController", function ($scope) {
	$scope.tabs = [
		{title: "Giver", content: '../views/giver-tab.php'},
		{title: "Receiver", content: "receiver description"}
	];
	console.log(tabs);

});

