var app = angular.module('todosApp');


app.factory("OrdersService", function($http, $timeout, $q){

    return {
        create: function(order){
            return $http({                
                method: 'POST',
                url: '/orders/orders/api/index.php/orders/',
                data: order
            })
            .then(function(response){
                console.debug("response : ", response);
                return response.data;
            });
        }
    };

});