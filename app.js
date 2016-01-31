// declare a module
var myApp = angular.module('MoxieApp', []);

// configure the module.
// in this example we will create a greeting filter
myApp.controller('mainController', function($http, $scope) {
    $http.get('http://api.openweathermap.org/data/2.5/forecast/daily?q=98564&mode=json&units=metric&cnt=14&APPID=69485212de3e99e43d9da0eb389f0a9d')
        .success(function(data) {
             $scope.name = data.city.name;
        })
        .error(function(error) {
            console.log('Error: ' + error);
        });
    });


