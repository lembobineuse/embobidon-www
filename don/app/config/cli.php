<?php

use Knp\Provider\ConsoleServiceProvider;
use Knp\Console\ConsoleEvents;
use Knp\Console\ConsoleEvent;

use Embobidon\Command\ClearCacheCommand;
use Embobidon\Command\ClearLogsCommand;


$app->register(new ConsoleServiceProvider(), [
    'console.name'              => 'Embobidon',
    'console.version'           => '1.0.0',
    'console.project_directory' => __DIR__.'/..'
]);

$app['dispatcher']->addListener(ConsoleEvents::INIT, function(ConsoleEvent $event) {
    $cli = $event->getApplication();
    $cli->add(new ClearCacheCommand());
    $cli->add(new ClearLogsCommand());
});
