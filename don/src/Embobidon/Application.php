<?php

namespace Embobidon;


class Application extends \Silex\Application
{
    use \Silex\Application\TwigTrait;
    use \Silex\Application\UrlGeneratorTrait;
    use \Silex\Application\TranslationTrait;
    use \Silex\Application\MonologTrait;
}
