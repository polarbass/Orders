var app = angular.module('todosApp');


app.controller('TodosCtrl', ['TodosService', '$scope', function(TodosService, $scope){

	var vm = this;

	var updateTodoList = function(todos){
		vm.todos = todos;
	}

	var resetNewTodoDescription = function(){
		vm.todoDescription = '';
	}

	var remaining = function(){
		return _.where(vm.todos, {done: false}).length;
	}

	var refresh = function(){

		var promise = TodosService.all();
		promise.then(function(data){
			console.debug(data);
			vm.todos = data;
			return data;
		})
		.then(updateTodoList);
	}

	var disableForm = function(){
		vm.formEnabled = false;
	}

	var enableForm = function(){
		vm.formEnabled = true;
	}

	var addTodo = function(form){

		if(form.$invalid) return;

		var todo = TodosService.buildWithDefaults(vm.todoDescription);
		disableForm();
		TodosService.create(todo)
			.then(refresh)
			.then(resetNewTodoDescription)
			.finally(enableForm);
	}

	var archive = function(){
		updateTodoList(TodosService.archive());
	}	

	// Expose les propriétés publiques
	vm.todos = [];
	vm.showDone = false;
	vm.todoDescription = '';
	
	// Expose les méthodes publiques
	vm.addTodo = addTodo;
	vm.remaining = remaining;
	vm.archive = archive;

	// Initialisation asynchrone de la liste
	refresh();

	
}]);