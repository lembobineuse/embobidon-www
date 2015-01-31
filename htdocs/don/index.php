<?php

ini_set('display_errors', 0);

$ROOT_DIR = __DIR__.'/../..';
require_once $ROOT_DIR . '/don/vendor/autoload.php';

$app = require $ROOT_DIR . '/don/src/app.php';
require $ROOT_DIR . '/don/config/prod.php';
require $ROOT_DIR . '/don/src/controllers.php';

$app['http_cache']->run();
