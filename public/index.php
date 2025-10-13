<?php



require_once __DIR__ . "/../config/config.php";
require_once __DIR__ . "/../config/db.php";
startSecureSession();

spl_autoload_register(function ($class){
    $directories = [
        '../app/Models',
        '../app/Controllers',
        '../app/Core',
    ];
    foreach ($directories as $directory){
        $file = __DIR__ . '/' . $directory .'/'. $class . '.php';
        if(file_exists($file)){
            require_once $file;
            return;
        }
    }
});


$URL = $_GET['url'];
$URL = explode('/', $URL);
$filename = '../app/Controllers/'. ucfirst($URL[0]) . 'Controller.php';

if(file_exists($filename)){
    require_once $filename;
    $controller = ucfirst($URL[0]) . 'Controller';
    $method = $URL[1] ?? 'index';
    
    if(!method_exists($controller, $method)){
        http_response_code(404);
        require_once __DIR__ . '/../app/Views/_404.php';
        exit;
    }
    
    $controller = new $controller($pdo);

    call_user_func_array([$controller, $method], []);
}else{
    http_response_code(404);
    $content = __DIR__ . '/../app/Views/_404.php';
    require __DIR__ . '/../app/Views/layouts/main.php';
}