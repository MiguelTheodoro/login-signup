<?php

class File {

    public static function Exist(string $file): bool {
        return file_exists((str_replace('.html', '', $file) . '.html'));
    }

    public static function Read(string $file): string {
        return @file_get_contents((str_replace('.html', '', $file) . '.html'));
    }

}
