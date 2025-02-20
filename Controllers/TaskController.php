<?php
require_once "Models/Task.php";

class TaskController {
    private $taskModel;

    public function __construct($conn) {
        $this->taskModel = new Task($conn);
    }

    public function index() {
      
      
    }

    public function save() {
    }

    public function delete() {
       
    }
}
?>
