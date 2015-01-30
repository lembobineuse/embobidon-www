<?php

// This check prevents access to debug front controllers that are deployed by accident to production servers.
// Feel free to remove this, extend it, or make something more sophisticated.
if (isset($_SERVER['HTTP_CLIENT_IP'])
    || isset($_SERVER['HTTP_X_FORWARDED_FOR'])
    || !in_array(@$_SERVER['REMOTE_ADDR'], array('127.0.0.1', 'fe80::1', '::1'))
) {
    header('HTTP/1.0 403 Forbidden');
    exit('You are not allowed to access this file. Check '.basename(__FILE__).' for more information.');
}

$ROOT_DIR = __DIR__.'/../..';
require_once $ROOT_DIR . '/don/vendor/autoload.php';

use Symfony\Component\Debug\Debug;


Debug::enable();

$app = require $ROOT_DIR . '/don/src/app.php';
require $ROOT_DIR . '/don/config/dev.php';
require $ROOT_DIR . '/don/src/controllers.php';

$app->run();
