<?php

class Model {

    public static function Parameter(string $url) {
        return preg_replace('/:\w+/', '', preg_replace_callback("/(?:@)(\w+)/", function(array $parameter){
            return "\/(?'" .  $parameter[1] . "'\w+)";
        }, $url));
    }

    public static function Query(string $url): string {
        return '\?' . implode('&', array_map(function(string $value){return $value . "=(?'$value'\w+)" ; }, explode(':', substr($url, strpos($url, ':') + 1))));
    }

    public static function Parse(string $url): string {

        $URL = '/^\/' . str_replace('/', '\/', trim($url, '/'));

        if(strpos($url, '@'))
            $URL .= self::Parameter(trim($url, '/'));

        if(strpos($url, ':'))
            $URL .= self::Query(trim($url, '/'));

        return $URL . '$/';
    }

}