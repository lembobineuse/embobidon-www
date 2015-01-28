<?php

require_once __DIR__.'/../vendor/autoload.php';

use Pimple\Container;
use Embo\Session;
use Embo\Router;

$app = new Container();

$app['session'] = function ($app) {
    return new Session();
};

$app['router'] = function ($app) {
    return new Router($app['session']);
};


$session = $app['session'];
$router = $app['router'];

$PAGES_DIR = __DIR__.'/pages';
$LANG = $session->getLanguage();
$current_route = $router->getCurrent();

if (file_exists($PAGES_DIR.'/'.$LANG.'/'.$current_route)) {
    $current_page = $PAGES_DIR.'/'.$LANG.'/'.$current_route.'.html';
} else {
    $current_page = $PAGES_DIR.'/fr/'.$current_route.'.html';
}


function fancybox ($images)
{
    foreach ($images as $img) {
        $html = <<<EOS
<a class="fancybox" rel="group" href="img/pics/$img.jpg">
    <img src="img/pics/${img}_tn.jpg" />
</a>
EOS;
        echo $html;
    }
}
