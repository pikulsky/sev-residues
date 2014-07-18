// create the module and name it scotchApp
var scotchApp = angular.module('scotchApp', [
	'ngRoute',
	'angular-loading-bar'
]);

// configure our routes
scotchApp.config(function($routeProvider) {
	$routeProvider

		// route for the home page
		.when('/', {
			templateUrl : searchBaseUrl + '/home.html',
			controller  : 'mainController'
		})

		// route for the about page
		.when('/about', {
			templateUrl : searchBaseUrl + '/about.html',
			controller  : 'aboutController'
		})

		// route for the contact page
		.when('/contact', {
			templateUrl : searchBaseUrl + '/contact.html',
			controller  : 'contactController'
		});
});

// create the controller and inject Angular's $scope
scotchApp.controller('searchController', function($scope, $http) {
	// create a message to display in our view
	$scope.message = 'Type to search';

	$scope.products = [];
	
	$scope.searchProducts = function() {
		$http.get('/search/searchproducts', {
			params: {
				query: $scope.query
			}
		}).success(function(data) {
			$scope.products = data;
		});
	};
	
	$scope.productsOrder = 'price';


//	$scope.products2 = [
//		{
//			'name': 'Цемент',
//			'price': 135,
//			'description': 'Два мешека цемента по 25 кг каждый',
//			'dateCreated': '2014-06-03 12:11:09'
//		},
//		{
//			'name': 'Гипсокартон',
//			'price': 15,
//			'description': 'Почти полный лист, влагостойкий',
//			'dateCreated': '2014-06-10 15:17:21'
//		},
//		{
//			'name': 'Шланги',
//			'price': 75,
//			'description': 'Длина 40см, 2шт.',
//			'dateCreated': '2014-06-10 15:21:21'
//		}
//	];
});

// create the controller and inject Angular's $scope
scotchApp.controller('mainController', function($scope) {
	// create a message to display in our view
	$scope.message = 'Everyone come and see how good I look!';
});

scotchApp.controller('aboutController', function($scope) {
	$scope.message = 'Look! I am an about page.';
});

scotchApp.controller('contactController', function($scope) {
	$scope.message = 'Contact us! JK. This is just a demo.';
});