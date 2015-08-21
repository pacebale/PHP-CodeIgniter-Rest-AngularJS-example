(function (angular) {
    "use strict";

    /*
     * Formats ng model as number with decimal places
     */
    angular.module('mainModule').directive('numberFormatter', ['$filter',
        function ($filter) {
        return {
            require: 'ngModel',
            restrict: 'A',
            link: function (scope, element, attrs, ctrl) {
                
                function validate(value){
                    
                    var newValue = value.replace(/\D/g,'');
                    element.val($filter('number')(newValue));
                    
                    return newValue;
                };
                
               ctrl.$parsers.unshift(validate);
               ctrl.$formatters.unshift(validate);
            }
        }
    }]);
})(angular)