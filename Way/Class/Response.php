<?php

class Response {

    public function HTML(string $file, array $propertys = NULL){
        try {
            return print(Template::Parse($file, $propertys));
        }
        catch(ErrorException $error){
            return $this -> Error($error -> getCode(), $error);
        }
    }

    public function Error($code, Exception $Error): string {
        http_response_code($code);
        return print_r($Error -> getMessage());
    }

    public function Redirect(string $url): void {
        header("Location: http://localhost" . DIRECTORY_SEPARATOR . preg_replace("/" . ".*htdocs\\" . DIRECTORY_SEPARATOR . "/", '', getcwd()) . DIRECTORY_SEPARATOR . trim($url, '/'));
    }

}