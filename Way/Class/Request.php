<?php

class Request {

    public function Body(): object {
        return (object) $_POST;
    }

    public static function Method(): string {
        return $_SERVER["REQUEST_METHOD"];
    }

    public static function Uri(): string {
        return Uri::Get();
    }

}