<?php

class ProjectsController extends Controller{
    private $projectModel;
    public function __construct($pdo){
        $this->projectModel = new Projects($pdo);
    }
    public function index(){
        $userId = User::currentUserID();
        $result = $this->projectModel->getAllProjects($userId);
        $projects = $result['data'] ?? [];
        $message = $result['message'] ?? '';
        
        $this->renderView('projects', 
        [
            'projects'=>$projects,
            'stylePath'=>'projects',
        ]);
    }   
}