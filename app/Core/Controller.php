<?php

class Controller{
    protected $userModel;

    public function __construct($pdo){
        $this->userModel = new User($pdo);
    }

    public function renderView(string $view, $data=['stylePath'=>'', 'aside'=>true] ){
        extract($data);
        
        $viewPath = strtolower(str_replace("Controller","", get_class($this)));
        $style = "/". ($data["stylePath"] ?? '') ."/$view.css";
        $content = __DIR__ . "/../Views/{$viewPath}/{$view}.php";
        
        $aside = isset($data['aside']) ? __DIR__ . '/../Views/sidebar.php' : null;
        require_once __DIR__ . "/../Views/layouts/main.php";
    }

}