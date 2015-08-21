(function (angular) {
    "use strict";

    /*
     * Directive that formatts ng model as percentage number
     */
    angular.module("mainModule").directive("percentageFormatter",
            ['$filter',
                function ($filter) {
                    return{
                        require: 'ngModel',
                        restrict: 'A',
                        link: function (scope, elem, attrs, ctrl) {

                            // Keep track of backspace presses for %
                            var backspacePressed = false;
                            elem.bind("keydown keypress", function (event) {
                                if (event.keyCode === 8) {
                                    backspacePressed = true;
                                }
                            });

                            function validate(value) {

                                var newValue = value.replace(/[^\d-]/g, '');
                                var number = parseFloat(newValue);

                                if (isNaN(number))
                                    number = 0;

                                if (number > 100.00 && !backspacePressed) {
                                    elem.val(100 + '%');
                                    return 1;
                                }else if(number > 100.00 && backspacePressed){
                                    elem.val(100);
                                    return 1;
                                }
                                ;
                                
                                if(backspacePressed)
                                    elem.val(number);
                                else
                                    elem.val(number + "%");
                                
                                backspacePressed = false;
                                return number / 100;
                            }
                            ;


                            ctrl.$parsers.unshift(validate);
                            ctrl.$formatters.unshift(validate);
                        }
                    };
                }
            ])

})(angular);

