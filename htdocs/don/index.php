<?php

ini_set('display_errors', 0);

require_once __DIR__.'/../../don/vendor/autoload.php';

$app = require __DIR__ . '/../../don/app/app.php';
require $app['config_dir'] . '/prod.php';
require $app['app_dir'] . '/controllers.php';

$app['http_cache']->run();
