<?php

class DashboardController extends Controller{
    protected $projectModel;
    protected $taskModel;
    

    public function __construct($pdo){
        $this->projectModel = new Projects($pdo);
        $this->taskModel = new Tasks($pdo);
    }

    public function index(){
        $userId = User::currentUserID();

        $taskResult = $this->taskModel->getRecentTasks($userId,5);
        $recentTasks = $taskResult['data'] ?? [];
        
        $projectResult = $this->projectModel->getRecentProjects($userId,5);
        $recentProjects = $projectResult['data'] ?? [];

        $this->renderView("dashboard", [
            'recentTasks' => $recentTasks,
            'recentProjects' => $recentProjects,
        ] );
    }
}