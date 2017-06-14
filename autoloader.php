<?php

spl_autoload_register('autoloader');

function autoloader($className)
{
    $classPath = 'src'. DIRECTORY_SEPARATOR . str_replace('\\', DIRECTORY_SEPARATOR, $className) . '.php';
    require_once $classPath;
}

