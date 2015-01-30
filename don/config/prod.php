<?php

use Monolog\Logger;


$app['locale'] = 'fr';
$app['cache_lifetime'] = 86400; // 24 hours

$app['app_dir'] = __DIR__.'/../src'; 
$app['tpl_dir'] = __DIR__.'/../templates'; 
$app['cache_dir'] = __DIR__.'/../cache';
$app['log_dir'] = __DIR__.'/../log';
$app['web_dir'] = __DIR__.'/../../htdocs/don';

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
