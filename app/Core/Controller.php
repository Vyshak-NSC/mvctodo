<?php

class Controller{
    protected $userModel;

    public function __construct($pdo){
        $this->userModel = new User($pdo);
    }

    public function renderView(string $view, $data=[], $stylePath=''){
        extract($data);
        
        $viewPath = strtolower(str_replace("Controller","", get_class($this)));
        $style = "/$stylePath/$view.css";
        $content = __DIR__ . "/../Views/{$viewPath}/{$view}.php";
        
        if($data['aside'] ?? ''){
            $aside = __DIR__ . '/../Views/sidebar.php';
        }
        require_once __DIR__ . "/../Views/layouts/main.php";
    }

}