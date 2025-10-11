<?php
require_once './config/session_init.php';
require __DIR__ . '/app/Models/User.php';
require __DIR__ . '/config/db.php';

startSecureSession();


if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = trim($_POST['username']) ?? '';
    $password = trim($_POST['password'] ?? '');

    $user = new User($pdo);
    $action = $_POST['action'] ??'';

    switch($action){
        case 'login': 
            $res = $user->login($username, $password);
            
            echo "Session ID  :" . session_id() . '<br>';
            echo 'current user:' . $user::currentUser() . '<br>';
            echo 'Log status:' . $user::isLoggedIn() . '<br>';
            echo 'Response    :' . $res['message'] . '<br>';
            break;
        case 'register':
            $res = $user->register($username, $password);
            echo 'Response    :' . $res['message'] . '<br>';
            
            break;
        case 'logout':
            $res = $user->logout();
            echo "response:" . $res['message'] . '<br>';
            break;
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
    <form action="test.php" method="post">
        <label for="username">Username</label>
        <input type="text" id="username" name="username">
        <br>
        <label for="password" type="text">Password</label>
        <input type="password" id="password" name="password">
        <button type="submit" name="action" value="login">Submit</button>
        <button name="action" value="logout" >Logout</button>
        <button name="action" value="register" >register</button>
    </form>
</body>
</html>