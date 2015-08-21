(function (angular) {
    "use strict";
    angular.module("mainModule").controller("MultiplikatorController",
            ['$scope', '$modal', '$timeout', 'multiplikatorService', '$routeParams',
                function ($scope, $modal, $timeout, multiplikatorService, $routeParams) {

                    // <editor-fold defaultstate="collapsed" desc="Fields">

                    $scope.form = {
                        depo: 0,
                        rez: 0,
                        pov: 0,
                        raz: 0
                    };

                    $scope.tableName = "";

                    var validToSave = false;

                    // </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Functions">

                    var id = $routeParams.id;
                    if (id !== null) {
                        multiplikatorService.getById(id).success(function (data) {
                            var data = data;
                            $scope.tableName = data.Naziv;
                            $scope.form.id = data.id;
                            $scope.form.depo = data.Depoziti;
                            $scope.form.raz = data.Razdoblje;
                            $scope.form.pov = data.Krediti;
                            $scope.form.rez = data.Rezerve;
                            $scope.calculate();
                        }).error(function (data) {
                            throw Error(data);
                        });
                    }
                    ;

                    // </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Functions">

                    $scope.calculate = function () {

                        // Make sure that there are values, and that there are no negatives before sending request
                        if ($scope.form.depo > 0 && $scope.form.rez > 0
                                && $scope.form.pov > 0 && $scope.form.raz > 0) {

                            multiplikatorService.calculate($scope.form).success(function (data) {
                                $scope.tableData = data;
                                validToSave = true;
                            }).error(function (data) {
                                throw Error(data);
                            });
                        }
                    };
                    // </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Modal">

                    $scope.save = function () {

                        var modalInstance = $modal.open({
                            templateUrl: 'modal.html',
                            controller: 'ModalController',
                            resolve: {
                                name: function () {
                                    return $scope.tableName;
                                }
                            }
                        });

                        // Open modal only if there is valid data in table
                        if (validToSave) {

                            modalInstance.result.then(function (name) {

                                var toSend = {
                                    data: $scope.form,
                                    tableName: name,
                                };

                                if (toSend.data.id === undefined) {
                                    multiplikatorService.save(toSend).success(function (data) {
                                        addAlert(saveSuccessAlert);
                                        $scope.tableName = toSend.tableName;
                                    }).error(function (data) {
                                        addAlert(saveFailedAlert);
                                        throw Error(data);
                                    });
                                } else {
                                    multiplikatorService.update(toSend).success(function (data) {
                                        addAlert(updateSuccessAlert);
                                        $scope.tableName = toSend.tableName;
                                    }).error(function (data) {
                                        addAlert(saveFailedAlert);
                                        throw Error(data);
                                    });
                                }

                            });
                        }
                    }
                    // </editor-fold>

                    // <editor-fold defaultstate="collapsed" desc="Alert">

                    var saveFailedAlert = {type: 'animate salert-box warning radius', msg: 'Neuspjelo snimanje.'};
                    var saveSuccessAlert = {type: 'animate alert-box success radius', msg: 'Snimljeno!'};
                    var updateSuccessAlert = {type: 'animate alert-box info radius', msg: 'Presnimljeno!'};
                    $scope.alerts = [];

                    function addAlert(alert) {
                        $scope.alerts.push(alert);

                        // close alert after 3 seconds
                        if ($scope.alerts.length > 0) {

                            $timeout(function () {
                                $scope.closeAlert($scope.alerts.length - 1);
                            }, 3000);
                        }
                    }
                    ;

                    $scope.closeAlert = function (index) {
                        $scope.alerts.splice(index, 1);
                    };

                    // </editor-fold>

                }]);

    angular.module("mainModule").controller('ModalController',
            ['$scope', '$modalInstance', 'name',
                function ($scope, $modalInstance, name) {

                    $scope.tableName = name;

                    $scope.save = function (value) {
                        $modalInstance.close(value);
                    };
                    $scope.cancel = function () {
                        $modalInstance.dismiss('cancel');
                    };
                }
            ]);
})(angular);