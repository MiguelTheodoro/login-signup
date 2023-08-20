<?php

class Uri {

    public static function Model(string $uri): string {
        return Model::Parse($uri);
    }

    public static function Get(): string {
        return '/' . substr($_SERVER["REQUEST_URI"], strrpos($_SERVER["REQUEST_URI"], basename(getcwd())) + strlen(basename(getcwd())) + 1 );
    }

}
