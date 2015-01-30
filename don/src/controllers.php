<?php

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;


$app
    ->get('/{_locale}/{page}', function (Request $request, Application $app) {
        $page = $request->get('page');

        $body = $app['twig']->render('static/index.html.twig', [
            'page' => $page
        ]);

        $response = new Response();

        $response->setContent($body)
            ->setStatusCode(200)
            ->setPublic()
            ->setSharedMaxAge($app['cache_lifetime'])
            ->setMaxAge($app['cache_lifetime'])
            ->setETag(md5($body))
        ;

        return $response;
    })
    ->assert('_locale', '^fr|en|ja$')
    ->value('_locale', 'fr')
    ->assert('page', '[\w-]+')
    ->value('page', 'lapelle')
    ->bind('page')
;

// Fetch campaign stats, Return JSON Response
$app
    ->get('/campaign_stats', function (Request $request, Application $app) {

        $service = $app['campaign_stats'];
        try {
            $stats = $service->fetchStats();
        } catch (\Exception $e) {
            return $app->json([
                'message' => $e->getMessage(),
                'status' => 500
            ], 500);
        }

        $response = new JsonResponse();
        $response->setCache([
            'etag'          => md5($stats['amount']),
            'last_modified' => new \DateTime(),
            'max_age'       => $app['cache_lifetime'],
            's_maxage'      => $app['cache_lifetime'],
            'private'       => false,
            'public'        => true,
        ]);
        $response->setData($stats);

        return $response;

    })
    ->bind('stats')
;
