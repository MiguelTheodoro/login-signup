<?php

class Template {

    private static $default = NULL;

    public static function Keys(array $propertys){
        return array_map(function(string $key){ return '/(<:\s*' . $key . '\s*:>)/'; }, array_keys($propertys));

    }

    private static function Simple(string $file, array $propertys = NULL): string {
        return self::Replace($file, $propertys);
    }

    private static function Complex(string $file, array $propertys = NULL): string {
        return self::Replace(
            self::$default['file'], array_merge(self::$default['propertys'], $propertys, ['body' => self::Simple($file, $propertys)])
        );
    }

    public static function Parse(string $file, array $propertys = NULL): string {

        if(!self::$default)
            return self::Simple($file, $propertys);

        return self::Complex($file, $propertys);
    }

    public static function Replace(string $file, array $propertys = NULL) {

        if(!File::Exist($file))
            throw new ErrorException("(Error): The { {$file} } File Is Non-Existent");


        if(!$propertys)
            return File::Read($file);


        return preg_replace(self::Keys($propertys), array_values($propertys), File::Read($file));

    }

    public static function Default(string $file, array $propertys): void {
        self::$default = ['file' => $file, 'propertys' => $propertys];
    }

}

