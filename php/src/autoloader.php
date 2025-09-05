<?php

declare(strict_types=1);

include_once realpath(__DIR__) . '/functions.php';
include_once realpath(__DIR__ . '/..') . '/vendor/autoload.php';

spl_autoload_register(function (string $className) {

    $prefix = "App\\";
    $baseDir = __DIR__ . '/';

    if ( ! str_starts_with($className, $prefix)) {
        return;
    }

    $relativeClass = substr($className, strlen($prefix));
    $file = $baseDir . str_replace("\\", '/', $relativeClass) . '.php';

    if (file_exists($file)) {
        require_once $file;
    }

});
