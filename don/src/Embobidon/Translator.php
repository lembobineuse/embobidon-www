<?php

namespace Embobidon;

use Symfony\Component\Translation\Translator as BaseTranslator;
use Symfony\Component\Translation\MessageSelector;

/**
 * Translator that gets the current locale from the Silex application.
 *
 * @author Fabien Potencier <fabien@symfony.com>
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
