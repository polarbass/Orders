(function(){

  angular.module('todosApp', ['ngRoute'])
    .config(function ($routeProvider) {
      $routeProvider
        .when('/', {
          templateUrl: 'views/order.html',
          controller: "OrdersCtrl",
          controllerAs: "ordersCtrl"
        })
        .when('/todos/:id', {
          templateUrl: 'views/detail.html',
          controller: "TodoDetailCtrl",
          controllerAs: "detailCtrl"
        })
        .otherwise({
          redirectTo: '/'
          //templateUrl: 'views/404.html'
        });
  });

})();


    /*.config(function($locationProvider){
      $locationProvider.html5Mode({
        enabled: true,
        requireBase: true,
        rewriteLink: false
      });
    })*/
