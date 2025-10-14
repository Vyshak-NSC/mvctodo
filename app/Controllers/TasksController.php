<?php

class TasksController extends Controller{
    private $taskModel;
    public function __construct($pdo){
        $this->taskModel = new Tasks($pdo);
    }
    public function index(){
        $result = $this->taskModel->getAllTasks();
        $tasks = $result['data'] ?? [];
        $message = $result['message'] ?? '';
        $this->renderView('Tasks', 
        [
            'success'=> $result['success'],
            'message'=> $message,
            'tasks'=>$tasks,
            'stylePath'=>'tasks',
        ]);
    }   
}