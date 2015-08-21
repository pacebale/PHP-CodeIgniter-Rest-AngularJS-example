(function (angular) {
    "use strict";

    /*
     * Formats ng model as number with decimal places
     */
    angular.module('mainModule').directive('decnumberFormatter', ['$filter',
        function ($filter) {
        return {
            require: 'ngModel',
            restrict: 'A',
            link: function (scope, element, attrs, ctrl) {
                
                function validate(value){
                    
                    var newValue = value.replace(/\D/g,'');
                    element.val($filter('number')(newValue/ 100, 2));
                    
                    return newValue / 100;
                };
                
               ctrl.$parsers.unshift(validate);
               ctrl.$formatters.unshift(validate);
            }
        }
    }]);
})(angular);