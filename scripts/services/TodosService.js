var app = angular.module('todosApp');

// Début d'un API asynchrone
app.factory("TodosService", function($http, $timeout, $q){

	return {     
		all: function(){

			return $http({
				method: 'GET',
				url: '/angular1/lab7/api/index.php/todos',
			})
			.then(function(response){
				console.debug("response: ", response);
				return response.data;
			});

		},     
		get: function(id){
			return $http({
				method: 'GET',
				url: '/angular1/lab7/api/index.php/todos/' + id,
			})
			.then(function(response){
				console.debug("response: ", response);
				return response.data;
			});
		},   
		buildWithDefaults: function(description){
			return {description: description || ""};
		},  		
		create: function(todo){
			return $http({
				method: 'POST',
				url: '/angular1/lab7/api/index.php/todos/',
				data: todo
			})
			.then(function(response){
				console.debug("response: ", response);
				return response.data;
			});
		},
		update: function(todo){
			return $http({
				method: 'PUT',
				url: '/angular1/lab7/api/index.php/todos/' + todo.id,
				data: todo
			})
			.then(function(response){
				console.debug("response: ", response);
				return response.data;
			});
		},
		archive: function(){
			return $http({
				method: 'POST',
				url: '/angular1/lab7/api/index.php/todos/archive'
			})
			.then(function(response){
				console.debug("response: ", response);
				return response.data;
			});

		}
	};

});