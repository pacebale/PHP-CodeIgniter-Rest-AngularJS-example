(function(angular){
      "use strict";
    angular.module("mainModule").controller("HomeController",[
        '$scope',
            function($scope){
            
            $scope.title = "neki naslov";
        }
    ]);
})(angular);