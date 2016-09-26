(function(){

angular.module("todosApp").factory("AuthService", function($q){
	
	return {
		check: function(requiredRole){
			
			return $q(function(resolve, reject){

				if(requiredRole === "admin"){
					console.debug("NO WAY!");
					reject("You do not have the required role. Poor you.");
				}

				console.debug("AUTHORIZED");
				return resolve("Yeah! You are authorized. Way to go buddy.");

			});

		}
	};

});

})();