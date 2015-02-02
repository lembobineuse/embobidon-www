<?php

use Monolog\Logger;


$app['locale'] = 'fr';
$app['cache_lifetime'] = 86400; // 24 hours

$app['root_dir'] = __DIR__.'/../../../';
$app['cache_dir'] = $app['root_dir'].'/don/cache';
$app['log_dir'] = $app['root_dir'].'/don/logs';
$app['web_dir'] = $app['root_dir'].'/htdocs/don';
$app['app_dir'] = __DIR__.'/../';
$app['tpl_dir'] = $app['app_dir'].'/resources/templates';

// Twig
$app['twig.path'] = $app['tpl_dir'];
$app['twig.options'] = [
    'cache' => $app['cache_dir'].'/twig'
];

// HTTP cache
$app['http_cache.cache_dir'] = $app['cache_dir'].'/http';
$app['http_cache.esi'] = null;

// Logging
$app['monolog.logfile'] = $app['log_dir'] . '/prod.log';
$app['monolog.level'] = Logger::WARNING;
