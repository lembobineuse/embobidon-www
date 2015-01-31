<?php

use Silex\Provider\UrlGeneratorServiceProvider;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\HttpCacheServiceProvider;
use Silex\Provider\TranslationServiceProvider;
use Silex\Provider\MonologServiceProvider;

use Embobidon\Application;
use Embobidon\Service\CampaignStatsService;


$app = new Application();

$app->register(new UrlGeneratorServiceProvider());
$app->register(new ServiceControllerServiceProvider());
$app->register(new HttpCacheServiceProvider());
$app->register(new TwigServiceProvider());

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

$app->register(new TranslationServiceProvider(), [
    'locale_fallbacks' => ['fr'],
]);

$app->register(new MonologServiceProvider());


// Campaign Stats Service
$app['campaign_stats'] = $app->share(function ($app) {
    return new CampaignStatsService();
});

return $app;
