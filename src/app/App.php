<?php

namespace app;

use core\controllers\Router;

class App
{
    public function run(): void
    {
        $this->handle();
    }

    private function handle(): void
    {
        require_once __DIR__ . '/../router.php';
        Router::action();
    }
}