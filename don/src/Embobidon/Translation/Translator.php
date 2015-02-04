<?php

namespace Embobidon\Translation;

use Symfony\Component\Translation\Translator as BaseTranslator;
use Symfony\Component\Translation\MessageSelector;
use Silex\Application;


/**
 * Translator that gets the current locale from the Silex application.
 * 
 * Updated to use the new $cacheDir parameter from
 * symfony/translation >= 2.6
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author ju1ius
 */
class Translator extends BaseTranslator
{
    protected $app;

    public function __construct(Application $app, MessageSelector $selector, $cachedir, $debug=false)
    {
        $this->app = $app;

        parent::__construct(null, $selector, $cachedir, $debug);
    }

    public function getLocale()
    {
        return $this->app['locale'];
    }

    public function setLocale($locale)
    {
        if (null === $locale) {
            return;
        }

        $this->app['locale'] = $locale;

        parent::setLocale($locale);
    }
}
