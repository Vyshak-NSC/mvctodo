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
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            // CSRF Validation
            if(!CSRF::validateToken($_POST['csrf_token']?? '')){
                $result = ['success'=>false, 'message'=> 'Security token invalid. Please try again.'];

                $this->renderView('register', ['result'=>$result,'aside'=>false]);
                exit;
            }

            $username = $_POST["username"] ?? '';
            $password = $_POST["password"] ?? '';

            $result = $this->userModel->register( $username, $password );
            
            if($result['success']){
                $message = urlencode($result['message']);
                $this->login();
                // header('Location:' .BASE_URL . 'auth/login&message=' . $message);
                exit;
            }
        }else{
            $message = $_GET['message'] ?? '';
            $result = ['success' => false,'message'=> $message];
        }

        $this->renderView('register', ['result'=>$result, 'stylePath'=>"auth",'aside'=>false]);
    }

    public function login(){
        if(User::isLoggedIn()){
            header('Location: '. BASE_URL .'home/index');
            exit;
        }
        if($_SERVER['REQUEST_METHOD'] == 'POST'){
            // CSRF Validation
            if(!CSRF::validateToken($_POST['csrf_token']?? '')){
                $result = ['success'=>false,'message'=> 'Security code invalid. Please try again'];
                $this->renderView('login', ['result'=>$result, 'stylePath'=>"auth",'aside'=>false]);
                exit;
            }

            $username = $_POST['username'] ??'';
            $password = $_POST['password'] ??'';

            $result = $this->userModel->login( $username, $password );
            
            if($result['success']){
                $message = $result['message'];
                header('Location:'. BASE_URL .'dashboard/index'); 
                exit;
            }
        }else{
            $message = $_GET['message'] ??'';

            $success = !empty($message);
            $result = ['success'=> $success,'message'=> $message];
        }

        $this->renderView('login',  ['result'=>$result, 'stylePath'=>"auth",'aside'=>false]);
    }

    public function logout(){
        $result = $this->userModel->logout();
        $message = $result['message'] ?? 'Logged out';
        $this->renderView('login',  ['result'=>$result, 'message'=>$message , 'stylePath'=>"auth",'aside'=>false]);
        exit;
    }
}