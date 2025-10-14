<?php

class ProjectsController extends Controller{
    private $projectModel;
    public function __construct($pdo){
        $this->projectModel = new Projects($pdo);
    }
    public function index(){
        $result = $this->projectModel->getAllProjects();
        $projects = $result['data'] ?? [];
        $message = $result['message'] ?? '';
        
        $this->renderView('projects', 
        [
            'success'=> $result['success'],
            'message'=> $message,
            'projects'=>$projects,
            'stylePath'=>'projects',
        ]);
    }   
}