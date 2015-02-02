<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Monolog\Logger;


$app->get('/', function (Request $request, Application $app) {
    return $app->redirect($app->url('page', [
        '_locale' => $app['locale'] ?: 'fr',
        'page' => 'lapelle'
    ]));
});
$app->get('/{_locale}', function (Request $request, Application $app) {
    return $app->redirect($app->url('page', [
        '_locale' => $request->get('_locale'),
        'page' => 'lapelle'
    ]));
})->assert('_locale', '^fr|en|ja$');

$app
    ->get('/{_locale}/{page}', function (Request $request, Application $app) {

        $page = $request->get('page');
        try {
            $body = $app['twig']->render('static/index.html.twig', [
                'page' => $page
            ]);
        } catch (\Twig_Error_Loader $e) {
            $app->abort(404);
        }

        return Response::create($body)->setCache([
            'last_modified' => new \DateTime(),
            'max_age'       => $app['cache_lifetime'],
            's_maxage'      => $app['cache_lifetime'],
            'private'       => false,
            'public'        => true,
        ]);
    })
    ->assert('_locale', '^fr|en|ja$')
    //->value('_locale', 'fr')
    ->assert('page', '[\w-]+')
    //->value('page', 'lapelle')
    ->bind('page')
;

// Fetch campaign stats, Return JSON Response
$app
    ->get('/campaign_stats', function (Request $request, Application $app) {

        $service = $app['campaign_stats'];
        try {
            $stats = $service->fetchStats();
        } catch (\Exception $e) {
            $app->log(
                $e->getMessage(),
                ['request_url' => '/campaign_stats'],
                Logger::ERROR
            );
            return $app->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }

        $cache_lifetime = 3600; // 1 hour
        return JsonResponse::create($stats)->setCache([
            'last_modified' => new \DateTime(),
            'max_age'       => $cache_lifetime,
            's_maxage'      => $cache_lifetime,
            'private'       => false,
            'public'        => true,
        ]);
    })
    ->bind('stats')
;

$app->error(function (\Exception $e, $code) use ($app) {
    if ($app['debug']) {
        return;
    }
    // 404.html, or 40x.html, or 4xx.html, or error.html
    $templates = [
        'errors/'.$code.'.html.twig',
        'errors/'.substr($code, 0, 2).'x.html.twig',
        'errors/'.substr($code, 0, 1).'xx.html.twig',
        'errors/default.html.twig',
    ];
    return new Response(
        $app['twig']->resolveTemplate($templates)->render(['code' => $code]),
        $code
    );
});
