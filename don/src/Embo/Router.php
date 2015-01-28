<?php

namespace Embo;

use Embo\Session;

/**
 * Routage du caca.
 */
class Router
{
    static private
        $ROUTES = [
            '01-aguicheur' => '01-aguicheur.html',
            '02-bateau-cool' => '02-bateau-cool.html',
            '03-errorism' => '03-errorism.html',
            '04-naufrage' => '04-naufrage.html',
            '05-conclusion' => '05-conclusion.html',
            '06-test' => '06-test.html',
        ],
        $VALID_ROUTES = null
    ;

    private
        $session = null
    ;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    /**
     * Hahahaha
     *
     * @return array Route name, page  to include 
     */
    public static function getCurrent()
    {
        $requested_route = '01-aguicheur';
        if (isset($_GET['p']) && in_array($requested_route, self::getValidRoutes())) {
            $requested_route = $_GET['p'];
        }
        return $requested_route;
    }
     
    /**
     * Get valid routes
     *
     * @return array
     */
    public static function getValidRoutes()
    {
        if (null === self::$VALID_ROUTES) {
            self::$VALID_ROUTES = array_keys(self::$ROUTES);
        }
        return self::$VALID_ROUTES;
    }
}
