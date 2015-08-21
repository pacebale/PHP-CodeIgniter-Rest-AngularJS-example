(function (angular) {
    "use strict";

    angular.module("mainModule").controller("NavigationController", [
        '$scope', '$location', 'navigationService',
        function ($scope, $location, navigationService) {

            // <editor-fold defaultstate="collapsed" desc="View models, scope items">

            $scope.title = "Multiplikator";
            $scope.menuItems = navigationService.getMenuItems();
            $scope.searchString = "";
            $scope.searchTable;

            // </editor-fold>

            // <editor-fold defaultstate="collapsed" desc="View model functions">

            /*
             * Menu items logic, sets active class and navigates to new view
             */
            $scope.navigate = function (index) {
                $scope.menuItems = navigationService.setMenuToActive(index);
            };

            /*
             * Get all data from tables
             */
            $scope.search = function () {

                if ($scope.searchString === "" || $scope.searchString === null) {
                    
                    navigationService.getAll($scope.searchString ).success(function (data) {
                        if(data.length > 0)
                            $scope.searchTable = data;
                        $location.path('searchView');
                    }).error(function (data) {
                        throw Error(data);
                    });
                }
                else{
                    
                    navigationService.getWhere($scope.searchString).success(function (data) {
                        $scope.searchTable = data;
                        $location.path('searchView');
                    }).error(function (data) {
                        throw Error(data);
                    });
                }
                    
            };
            
            /*
             * Deletes entity
             * int index
             * obj entity do delete
             */
            $scope.delete = function(index,entity){
                
                navigationService.delete(entity).success(function(){
                    $scope.searchTable.splice(index,1);
                }).error(function(data){
                   throw Error(data); 
                });
            };
            
           /*
            * Redirects to multiplikator with given dada
            */
            $scope.selectType = function(data){
             
               $location.path('multiplikator/' + data.id);
            };
            
            // </editor-fold>
        }
    ]);
})(angular);
