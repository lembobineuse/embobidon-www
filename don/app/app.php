<?php

use Embobidon\Application;


$app = new Application();

$app['app_dir'] = __DIR__;
$app['config_dir'] = __DIR__.'/config';
$app['root_dir'] = __DIR__.'/../..';

$app['cache_dir'] = __DIR__.'/../var/cache';
$app['log_dir'] = __DIR__.'/../var/logs';
$app['tpl_dir'] = __DIR__.'/resources/views';

$app['web_dir'] = $app['root_dir'].'/htdocs/don';

$app['donate_url'] = 'http://www.helloasso.com/associations/l-embobineuse/collectes/embobidon/faire-un-don';

$app['assets_version'] = require $app['config_dir'] . '/assets_version.php';

return $app;
