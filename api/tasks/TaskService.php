<?php
class TaskService {
    
    public static function listTasks() {
        $db = ConnectionFactory::getDB();
        $tasks = array();
        
        foreach($db->tasks() as $task) {
           $tasks[] = array (
               'id' => $task['id'],
               'description' => $task['description'],
               'done' => $task['done'] ? true : false
           ); 
        }
        
        return $tasks;
    }

    public static function archiveTasks() {
        $db = ConnectionFactory::getDB();
        $tasks = array();
        
        foreach($db->tasks() as $task) {
           $tasks[] = array (
               'id' => $task['id'],
               'description' => $task['description'],
               'done' => $task['done'] ? true : false
           ); 
        }
        
        return $tasks;
    }
    
    public static function getById($id) {
        $db = ConnectionFactory::getDB();
        return $db->tasks[$id];
    }
    
    public static function add($newTask) {
        $db = ConnectionFactory::getDB();
        $task = $db->tasks->insert(array("description" => $newTask['description'], "done" => 0)); //$newTask);
        return $task;
    }
    
    public static function update($updatedTask) {
        $db = ConnectionFactory::getDB();
        $task = $db->tasks[$updatedTask['id']];
        
        if($task) {
            $task['description'] = $updatedTask['description'];
            $task['done'] = $updatedTask['done'];
            $task->update();
            return true;
        }
        
        return false;
    }
    
    public static function delete($id) {
        $db = ConnectionFactory::getDB();
        $task = $db->tasks[$id];
        if($task) {
            $task->delete();
            return true;
        }
        return false;
    }
}
?>