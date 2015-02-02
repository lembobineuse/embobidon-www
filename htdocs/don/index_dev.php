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

require_once __DIR__.'/../../don/vendor/autoload.php';

use Symfony\Component\Debug\Debug;


Debug::enable();

$app = require __DIR__ . '/../../don/app/app.php';
require $app['config_dir'] . '/dev.php';
require $app['app_dir'] . '/controllers.php';

$app->run();
