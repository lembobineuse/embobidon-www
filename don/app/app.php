<?php

use Embobidon\Application;


$app = new Application();

$app['app_dir'] = __DIR__;
$app['config_dir'] = __DIR__.'/config';
$app['root_dir'] = __DIR__.'/../..';

$app['cache_dir'] = __DIR__.'/cache';
$app['log_dir'] = __DIR__.'/logs';
$app['tpl_dir'] = __DIR__.'/resources/views';

$app['web_dir'] = $app['root_dir'].'/htdocs/don';

return $app;