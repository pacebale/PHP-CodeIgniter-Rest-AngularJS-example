


(function (angular) {

    "use strict";

    angular.module("mainModule", ['ngRoute', 'ngAnimate', 'mm.foundation'])
            .config(function ($routeProvider) {

                $routeProvider
                        .when("/searchView",{
                           templateUrl: 'app/navigation/searchView.html'
                        })
                        .when("/home", 
                        {
                            templateUrl: 'app/home/home.html',
                            controller: 'HomeController'
                        })
                       .when("/multiplikator",
                        {
                            templateUrl: 'app/multiplikator/multiplikator.html',
                            controller: 'MultiplikatorController'
                        })
                        .when("/multiplikator/:id",
                        {
                            templateUrl: 'app/multiplikator/multiplikator.html',
                            controller: 'MultiplikatorController'
                        })
                        .otherwise({redirectTo: '/searchView'});



            });
})(angular);