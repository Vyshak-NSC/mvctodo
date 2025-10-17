<?php

class Controller{
    protected $model;

    public function __construct($pdo){
        // $this->model = new User($pdo);
    }

    public function renderView(string $view, $params=[] ){
        $defaultparams = [
            'stylePath'=>'',
            'aside'=>true,
            'components'=>[]
        ];
        $componentStyles = [];

        
        $params = array_merge($defaultparams, $params);
        extract($params);
        foreach($params['components'] as $path){
            $componentStyles[] = "/$path.css";
        }

        $viewPath = strtolower(str_replace("Controller","", get_class($this)));
        
        $style = "/". ($stylePath ?? '') ."/$view.css";
        $content = __DIR__ . "/../Views/$viewPath/$view.php";

        $aside = ($params['aside'] && User::isLoggedIn()) ? __DIR__ . '/../Views/sidebar.php' : null;
        require_once __DIR__ . "/../Views/layouts/main.php";
    }
}