<?php

class AuthController extends Controller{
    private $userModel;
    public function __construct($pdo){
        $this->userModel = new User($pdo);
    }

    public function register(){
        if(User::isLoggedIn()){
            header("Location: {BASE_URL}/home/index");
            exit;
        }
        $result = ['success' => false, 'message' => ''];

        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // CSRF Validation
            if(!CSRF::validateToken($_POST['csrf_token']?? '')){
                $result = ['message'=> 'Security token invalid. Please try again.'];
            }

            $username = $_POST["username"] ?? '';
            $password = $_POST["password"] ?? '';

            $result = $this->userModel->register( $username, $password );
            
            if($result['success']){
                $message = urlencode($result['message']);
                // $this->login();
                header('Location:' .BASE_URL . 'auth/login?message=' . $message);
                exit;
            }
        }else{
            $result['message'] = $_GET['message'] ?? '';
        }

        $this->renderView('register', ['result' => $result,'stylePath'=>"auth",'aside'=>false]);
    }

    public function login(){
        if(User::isLoggedIn()){
            header('Location: '. BASE_URL .'home/index');
            exit;
        }
        $result = ['success' => false, 'message' => $_GET['message'] ?? ''];
    
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // CSRF Validation
            if(!CSRF::validateToken($_POST['csrf_token']?? '')){
                $result = ['success'=>false,'message'=> 'Security code invalid. Please try again'];
            }

            $username = $_POST['username'] ??'';
            $password = $_POST['password'] ??'';

            $result = $this->userModel->login( $username, $password );
            
            if($result['success']){
                header('Location:'. BASE_URL .'dashboard/index'); 
                exit;
            }
        }

        $this->renderView('login',  ['result' => $result,'stylePath'=>"auth",'aside'=>false]);
    }

    public function logout(){
        $result = $this->userModel->logout();
        $message = $result['message'] ?? 'Logged out';
        $this->renderView('login',  ['result' => $result, 'stylePath'=>"auth",'aside'=>false]);
        exit;
    }
}