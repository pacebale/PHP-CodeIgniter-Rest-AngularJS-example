(function (angular) {
    "use strict";

    angular.module("mainModule").service("multiplikatorService",
            ['$http',
                function ($http) {

                    var url = 'index.php/Api_Rest/';

                    // Calculates table values
                    this.calculate = function (toSend) {

                        return $http({
                            method: 'post',
                            url: url + "calculate",
                            data: toSend
                        });
                    };
                    
                    // Get table data by id
                    this.getById = function(id){
                        return $http.get(url + "byId/id/" + id + "/format/json");
                    };
                    
                    // Updates table and values
                    this.update = function(toSend){
                        
                         return $http({
                            method: 'put',
                            url: url + "update",
                            data: toSend
                        });
                    };

                    // Saves table and values
                    this.save = function (toSend) {

                        return $http({
                            method: 'post',
                            url: url + "save",
                            data: toSend
                        });
                    };


                }
            ]);


})(angular);
