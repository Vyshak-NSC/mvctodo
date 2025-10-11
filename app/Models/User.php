<?php

class User{
    public $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    // REGISTER
    public function register($username, $password){
        $username = trim($username);
        $password = trim($password);

        if(empty($username) || empty($password)){
            return ['success'=> false, 'message'=>'Username and password cannot be empty'];
        }

        $stmt = $this->pdo->prepare("SELECT id from users WHERE username=:username LIMIT 1");
        $stmt->execute(["username"=> $username]);
        if($stmt->fetch()) return ['success' => false, 'message'=> 'Username already exists.'];
        
        try{
            $stmt = $this->pdo->prepare("INSERT INTO users(username, password) VALUES(:username, :password)");
            $stmt->execute([
                'username' => $username,
                'password' => password_hash($password, PASSWORD_DEFAULT)
            ]);
            return ["success"=> true,"message"=> "User Resgistered."];
       
        }catch(PDOException $e){
            return ['success' => false, 'message' => $e->getMessage()];
        }
    }

    // LOGIN
    public function login($username, $password){
        if(self::isLoggedIn()){
            return ['success'=> false, 'message'=> 'User already logged in.'];
        }
        $username = trim($username);
        $password = trim($password);
        
        if(empty($username) || empty($password)){
            return ['success'=> false,'message'=> 'Username and password cannot be empty.'];
        }
        
        $stmt = $this->pdo->prepare("SELECT * FROM users WHERE username=:username LIMIT 1");
        $stmt->execute(["username"=> $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if(!$user || !password_verify($password, $user['password']))
            return ['success'=>false, 'message' => 'Invalid username or password.'];

        session_regenerate_id(true);
            
        $_SESSION["id"] = (int)$user["id"];
        $_SESSION["username"] = $user["username"];
        $_SESSION["last_active"] = time();
        return ["success"=> true,"message"=> "User Logged in."];
        
    }

    // LOGOUT
    public function logout(){
        // if(!self::isLoggedIn())
        //     return ["success"=> false,"message"=> "No user logged in"];
        // session_unset();
        $_SESSION = [];
        $params = session_get_cookie_params();
        // reset cookies?
        setcookie(session_name(), '', [
            'expires' => time()-42000,
            'path' => $params['path'],
            'domain' => $params['domain'],
            'secure' => $params['secure'],
            'httponly' => $params['httponly'],
            'samesite' => 'Strict'
        ]);

        session_destroy();
        return ["success"=> true,"message"=> "User logged out"];
    }

    public static function isLoggedIn(){
        return isset($_SESSION['id']);
    }

    public static function currentUser(){
        return self::isLoggedIn() ? $_SESSION['username'] : null;
    }

    public function getById(int $id){
        $stmt = $this->pdo->prepare("SELECT id,username FROM users WHERE id =?");
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}