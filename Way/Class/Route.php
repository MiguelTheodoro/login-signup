<?php

class Route {

    public static $All = ['GET' => [], 'POST' => []];

    public static function Get(string $Uri, $Function): void {
        self::$All['GET'][Uri::Model($Uri)] = $Function;
    }

    public static function Post(string $Uri, $Function): void {
        self::$All['POST'][Uri::Model($Uri)] = $Function;
    }

}