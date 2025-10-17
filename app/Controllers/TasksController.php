<?php

class TasksController extends Controller{
    private $taskModel;
    public function __construct($pdo){
        $this->taskModel = new Tasks($pdo);
    }
    public function index(){
        $userId = User::currentUserID();
        if(!$userId){
            header("Location: ".BASE_URL."auth/login?message=Please+login+to+access+the+dashboard");
            exit;
        }
        $result = $this->taskModel->getAllTasks($userId);
        $tasks = $result['data'] ?? [];
        $message = $result['message'] ?? '';
        
        $this->renderView('tasks', 
        [
            'tasks'=>$tasks,
            'stylePath'=>'tasks',
            'components'=>['tasks']
        ]);
    }   
}