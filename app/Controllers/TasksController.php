<?php

class TasksController extends Controller{
    private $taskModel;
    public function __construct($pdo){
        $this->taskModel = new Tasks($pdo);
    }
    public function index(){
        $userId = User::currentUserID();
        $result = $this->taskModel->getAllTasks($userId);
        $tasks = $result['data'] ?? [];
        $message = $result['message'] ?? '';
        $this->renderView('Tasks', 
        [
            'tasks'=>$tasks,
            'stylePath'=>'tasks',
        ]);
    }   
}