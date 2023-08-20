<?php

class Server {

    public static function Run(): void {
        Server::Handle();
    }

    private static function Handle(): void {
        foreach(Route::$All[Request::Method()] as $Route => $Method){
            if(preg_match($Route, Request::Uri(), $Match)){
                $Method(new Request(), new Response()); return;
            }
        }
    }

}
