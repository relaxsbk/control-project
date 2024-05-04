<?php

use app\App;

spl_autoload_register(function ($name) {
    require_once __DIR__ . "/src/" . str_replace("\\", "/", $name) . ".php";
});

    $app = new App();
    $app->run();

