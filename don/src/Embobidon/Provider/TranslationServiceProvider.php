<?php

namespace Embobidon\Provider;

use Silex\Application;
use Silex\ServiceProviderInterface;
use Symfony\Component\Translation\MessageSelector;
use Symfony\Component\Translation\Loader\ArrayLoader;
use Symfony\Component\Translation\Loader\XliffFileLoader;

use Embobidon\Translation\Translator;

/**
 * Symfony Translation component Provider.
 *
 * Updated to use the new $cacheDir parameter from
 * symfony/translation >= 2.6
 *
 * @author Fabien Potencier <fabien@symfony.com>
 * @author ju1ius
 */
class TranslationServiceProvider implements ServiceProviderInterface
{
    public function register(Application $app)
    {
        $app['translator'] = $app->share(function ($app) {
            $translator = new Translator(
                $app,
                $app['translator.message_selector'],
                $app['translator.cache_dir'],
                $app['debug']
            );
            // Handle deprecated 'locale_fallback'
            if (isset($app['locale_fallback'])) {
                $app['locale_fallbacks'] = (array) $app['locale_fallback'];
            }

            $translator->setFallbackLocales($app['locale_fallbacks']);

            $translator->addLoader('array', new ArrayLoader());
            $translator->addLoader('xliff', new XliffFileLoader());

            foreach ($app['translator.domains'] as $domain => $data) {
                foreach ($data as $locale => $messages) {
                    $translator->addResource('array', $messages, $locale, $domain);
                }
            }

            return $translator;
        });

        $app['translator.message_selector'] = $app->share(function () {
            return new MessageSelector();
        });

        $app['translator.domains'] = array();
        $app['locale_fallbacks'] = array('en');
    }

    public function boot(Application $app)
    {
    }
}
