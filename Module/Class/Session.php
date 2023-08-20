<?php


class Session {

    public static function Start(): void {
        session_start();
    }

    public static function Reset(): void {
        session_unset();
    }

    public static function Exist(): bool {
        return !!$_SESSION;
    }

    public static function ExistKey(string $key): bool {
        return isset($_SESSION[$key]);
    }

    public static function Add($value, $key): void {

        if(!$key){
            array_push($_SESSION, $value);
        }

        else if(!self::ExistKey($key)){
            $_SESSION[$key] = $value;
        }

        else {
            $_SESSION[$key] = array($_SESSION[$key], $value);
        }
    }

    public static function Remove(string $key): void{
        if(self::ExistKey($key))
            unset($_SESSION[$key]);
    }

    public static function Get(string $Key){
        return self::ExistKey($Key) ? $_SESSION[$Key] : NULL;
    }

    public static function /*&*/ Complete(): array {
        if(self::Exist()){
            return $_SESSION;
        }
        return [];
    }
}
