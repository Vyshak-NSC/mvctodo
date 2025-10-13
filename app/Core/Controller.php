<?php

class Controller{
    protected $userModel;

    public function __construct($pdo){
        $this->userModel = new User($pdo);
    }

    public function renderView(string $view, $params=[] ){
        $defaultparams = [
            'stylePath'=>'',
            'aside'=>true,
        ];
        $params = array_merge($defaultparams, $params);
        extract($params);
        
        $viewPath = strtolower(str_replace("Controller","", get_class($this)));
        $style = "/". ($params["stylePath"] ?? '') ."/$view.css";
        $content = __DIR__ . "/../Views/$viewPath/$view.php";

        $aside = ($params['aside'] && User::isLoggedIn()) ? __DIR__ . '/../Views/sidebar.php' : null;
        require_once __DIR__ . "/../Views/layouts/main.php";
    }
}