<?php

use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\MonologServiceProvider;
use Monolog\Logger;

use Embobidon\Service\CampaignStatsService;


$app['locale'] = 'fr';
$app['cache_lifetime'] = 86400; // 24 hours

// ========== Services ========== //

$app->register(new UrlGeneratorServiceProvider());
$app->register(new ServiceControllerServiceProvider());

// ----- HTTP cache
$app->register(new HttpCacheServiceProvider(), [
    'http_cache.cache_dir' => $app['cache_dir'].'/http',
    'http_cache.esi' => null
]);

// ----- Twig
$app->register(new TwigServiceProvider(), [
    'twig.path' => $app['tpl_dir'],
    'twig.options' => [
        'cache' => $app['cache_dir'].'/twig'
    ]
]);
// Templating helpers
$app['twig'] = $app->share($app->extend('twig', function($twig, $app) {

    $twig->addFunction(new \Twig_SimpleFunction('asset', function ($path) use ($app) {
        return $app['request']->getBasePath() . '/' . $path;
    }));

    $twig->addFunction(new \Twig_SimpleFunction('page', function ($page) use ($app) {
        return $app->path('page', [
            'page' => $page,
            '_locale' => $app['locale'] ?: 'fr'
        ]);
    }));

    return $twig;
}));

// ----- Translations
$app->register(new TranslationServiceProvider(), [
    'locale_fallbacks' => ['fr'],
    'locale' => $app['locale']
]);
$app['translator'] = $app->share($app->extend('translator', function($translator, $app) {
    $translator->addLoader('yaml', new YamlFileLoader());

    $translator->addResource('yaml', __DIR__.'/../resources/translations/messages.fr.yml', 'fr');
    $translator->addResource('yaml', __DIR__.'/../resources/translations/messages.en.yml', 'en');
    $translator->addResource('yaml', __DIR__.'/../resources/translations/messages.ja.yml', 'ja');

    return $translator;
}));

// ----- Logging
$app->register(new MonologServiceProvider(), [
    'monolog.logfile' => $app['log_dir'] . '/prod.log',
    'monolog.level' => Logger::ERROR
]);


// ----- Campaign Stats Service
$app['campaign_stats'] = $app->share(function ($app) {
    return new CampaignStatsService();
});
