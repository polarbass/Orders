(function(){

	var app = angular.module('todosApp');

	app.controller('TodoDetailCtrl', ['$routeParams', '$location', 'TodosService', function($routeParams, $location, TodosService){

		var vm = this;

		vm.loading = true;

		TodosService.get($routeParams.id)
			.then(function(todo){
				console.debug(todo);
				vm.todo = todo;
			})
			.finally(function(){
				vm.loading = false;
			});


		vm.save = function(form){

			if(form.$invalid) return;

			TodosService.update(vm.todo)
				.then(function(){
						$location.path('/');
					}, 
					function(){
						alert("Les données n'ont pas été sauvegardées.");
					});

		}


	}]);


})();