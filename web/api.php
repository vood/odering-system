<?php

require_once __DIR__ . '/../vendor/autoload.php';

$config = require __DIR__ . '/../config/config.php';

$app = new \vood\OrderingSystem\Application($config);

$app->run();