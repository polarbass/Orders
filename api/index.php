<?php
require 'vendor/autoload.php';
require 'database/ConnectionFactory.php';
require 'tasks/TaskService.php';
require 'tasks/OrderService.php';

$app = new \Slim\Slim();

// http://hostname/api/index.php/
$app->get('/', function() use ( $app ) {
    echo "Welcome to TODO REST API";
});

/*
HTTP GET http://domain/api/index.php/todos
RESPONSE 200 OK
[
  {
    "id": 1,
    "description": "Learn REST",
    "done": false
  },
  {
    "id": 2,
    "description": "Learn JavaScript",
    "done": false
  },
  {
    "id": 3,
    "description": "Learn English",
    "done": false
  }
]
*/
$app->get('/todos/', function() use ( $app ) {
    $tasks = TaskService::listTasks();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($tasks);
});

/*
HTTP POST http://domain/api/index.php/todos/archive
RESPONSE 200 OK
*/
$app->post('/todos/archive', function() use ( $app ) {
    $tasks = TaskService::archiveTasks();
    $app->response()->header('Content-Type', 'application/json');
    echo json_encode($tasks);
});


/*
HTTP GET http://domain/api/index.php/todos/1
RESPONSE 200 OK
{
  "id": 1,
  "description": "Learn REST",
  "done": false
}
*/
$app->get('/todos/:id', function($id) use ( $app ) {

    $task = TaskService::getById($id);
    
    if($task) {
        $app->response()->header('Content-Type', 'application/json');
        echo json_encode($task);
    }
    else {
        $app->response()->setStatus(204);
    }
});

/*
HTTP POST http://domain/api/index.php/todos
REQUEST Body
{
  "description": "Learn REST",
}

RESPONSE 204 No Content
Learn REST added
*/
$app->post('/todos/', function() use ( $app ) {
    $taskJson = $app->request()->getBody();
    $newTask = json_decode($taskJson, true);
    if($newTask) {
        $task = TaskService::add($newTask);
        echo "Task {$taskJson} added";
        //$app->response->setStatus(500);
    }
    else {
        $app->response->setStatus(400);
        echo "Malformat JSON";
    }
});

$app->post('/orders/', function() use ( $app ) {
    $orderJson = $app->request()->getBody();
    $newOrder = json_decode($orderJson, true);
    if($newOrder) {
        $order = OrderService::add2($newOrder);
        echo "Order {$orderJson} added";
    }
    else {
        $app->response->setStatus(400);
        echo "Malformat JSON";
    }
});

/*
HTTP PUT http://domain/api/index.php/todos/1
REQUEST Body
{
  "id": 1,
  "description": "Learn REST",
  "done": false
}

RESPONSE 200 OK
{
  "id": 1,
  "description": "Learn REST",
  "done": false
}
*/
$app->put('/todos/:id', function() use ( $app ) {
    $taskJson = $app->request()->getBody();
    $updatedTask = json_decode($taskJson, true);
    
    if($updatedTask && $updatedTask['id']) {
        if(TaskService::update($updatedTask)) {
          echo "Task {$updatedTask['description']} updated";  
        }
        else {
          $app->response->setStatus('404');
          echo "Task not found";
        }
    }
    else {
        $app->response->setStatus(400);
        echo "Malformat JSON";
    }
});

/*
HTTP DELETE http://domain/api/index.php/todos/1
RESPONSE 200 OK
Task with id = 1 was deleted
RESPONSE 404
Task with id = 1 not found
*/
$app->delete('/todos/:id', function($id) use ( $app ) {
    if(TaskService::delete($id)) {
      echo "Task with id = $id was deleted";
    }
    else {
      $app->response->setStatus('404');
      echo "Task with id = $id not found";
    }
});

function change_nums_to_bools(Array $data){
    // Note the order of arguments and the & in front of $value 
    function converter(&$value, $key){
        if($key == "done"){
            $value = ($value == 0 ? false : true);
        }
    }
    array_walk_recursive($data, 'converter');
    return $data;
}

$app->run();
?>