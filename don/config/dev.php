<?php

require __DIR__.'/prod.php';

use Silex\Provider\WebProfilerServiceProvider;
use Monolog\Logger;


$app['debug'] = true;

// Twig
$app['twig.options'] = array_merge($app['twig.options'], [
    'debug' => true,
    'strict_variables' => true
]);

// HTTP Cache
$app['http_cache.options'] = [
    'debug' => true
];

// Logging
$app['monolog.logfile'] = $app['log_dir'] . '/dev.log';
$app['monolog.level'] = Logger::DEBUG;

// Profiler
$app->register(new WebProfilerServiceProvider(), [
    'profiler.cache_dir' => $app['cache_dir'] . '/profiler',
    'profiler.mount_prefix' => '/_profiler',
]);
