<?php


spl_autoload_register(function($anything): void {

    $Dirs = ["Way", "Module"];

    $Base = getcwd() . DIRECTORY_SEPARATOR;


    foreach($Dirs as $dir)

        if(file_exists($Base . $dir .  DIRECTORY_SEPARATOR . 'Class' . DIRECTORY_SEPARATOR . "{$anything}.php"))

            require_once($Base . $dir .  DIRECTORY_SEPARATOR . 'Class' . DIRECTORY_SEPARATOR . "{$anything}.php");




});