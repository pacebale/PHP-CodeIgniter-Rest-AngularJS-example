(function (angular) {
    "use strict";

    angular.module("mainModule").service("navigationService",
            ['$http', '$location',
                function ($http, $location) {

                    var url = 'index.php/Api_Rest/';

                    var menuItems = [
                        {title: "O multiplikatorima", class: "active", href: "#/home"},
                        {title: "Multiplikator", class: "", href: "#/multiplikator"},
                        {title: "Pretrazi snimljeno", class: "", href: "#/searchView"}
                    ];

                    /*
                     * Set menu item class to active, for rest sets to empty
                     * Navigates to new view
                     * @params int index - menu item index
                     * @return array menuItems - return menu items
                     */
                    this.setMenuToActive = function (index) {

                        for (var i in menuItems) {
                            menuItems[i].class = "";
                        }
                        ;
                        menuItems[index].class = "active";
                        return menuItems;
                    };

                    /*
                     * Return menu items
                     */
                    this.getMenuItems = function () {
                        return menuItems;
                    };

                    /*
                     * Gets all table names
                     */
                    this.getAll = function () {
                        return $http.get(url + "all/format/json");
                    };

                    /*
                     * Gets table with name like search
                     * @param string search - search string
                     */
                    this.getWhere = function (search) {
                        return $http.get(url + "where/name/" + search);
                    };

                    /*
                     * Deletes from baze
                     * data = {
                     *  type: mikro or makro
                     *  id : int to delete
                     * }
                     */
                    this.delete = function (data) {
                        return $http({
                            method: 'delete',
                            url: url + "delete/Tip/" + data.Tip + "/id/" + data.id,
                        });
                    };
                }


            ]);


})(angular);