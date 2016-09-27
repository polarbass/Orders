var app = angular.module('todosApp');


app.controller('OrdersCtrl', ['OrdersService', '$scope', function(OrdersService, $scope){

    var vm = this;

    var addOrder = function(form){

        if(form.$invalid) return;

        var order = {name : vm.name, address : vm.address, town : vm.town, postalCode : vm.postalcode, phone : vm.phone};

        OrdersService.create(order);

    }

    // Expose les propriétés publiques
    vm.order = [];
    vm.name = '';
    vm.address = '';
    vm.town = '';
    vm.postalcode = '';
    vm.phone = '';

    // Expose les méthodes publiques
    vm.addOrder = addOrder;

    //Test

}]);