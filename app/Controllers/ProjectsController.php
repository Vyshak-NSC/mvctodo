<?php

class ProjectsController extends Controller{
    private $projectModel;
    private $taskModel;

    public function __construct($pdo){
        $this->projectModel = new Projects($pdo);
        $this->taskModel = new Tasks($pdo);
    }
    public function index(){
        $userId = User::currentUserID();
        if(!$userId){
            header("Location: ".BASE_URL."auth/login?message=Please+login+to+access+the+dashboard");
            exit;
        }
        $result = $this->projectModel->getAllProjects($userId);
        $projects = $result['data'] ?? [];
        $message = $result['message'] ?? '';
        
        $this->renderView('projects', 
        [
            'projects'=>$projects,
            'stylePath'=>'projects',
            'components'=>['projects']
        ]);
    }   

    public function show($projectId){
        $userId = User::currentUserID();
        if(!$userId){
            header("Location: ".BASE_URL."auth/login?message=Please+login+to+access+the+dashboard");
            exit;
        }

        $projectResult = $this->projectModel->getProjectById($projectId);
        $taskResult = $this->taskModel->getTasksByProjectId($projectId);

        if($projectResult['success'] && $taskResult['success']){
            $this->renderView('show',
            [
                'project'=>$projectResult['data'],
                'tasks'=>$taskResult['data'],
                'stylePath'=>'projects',
            ]);
        }
    }
}