<?php

class CSRF{
    const TOKEN_KEY = 'csrf_token';

    public static function generateToken(){
        if(!isset($_SESSION[self::TOKEN_KEY])){
            $_SESSION[self::TOKEN_KEY] = bin2hex(random_bytes(32));
        }
        return $_SESSION[self::TOKEN_KEY];
    }

    public static function getToken(){
        return $_SESSION[self::TOKEN_KEY];
    }

    public static function validateToken($token){
        if(isset($_SESSION[self::TOKEN_KEY])){
            return hash_equals($_SESSION[self::TOKEN_KEY], $token);
        }
        return false;
    }
}