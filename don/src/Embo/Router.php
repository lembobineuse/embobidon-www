<?php

namespace Embo;

use Embo\Session;

/**
 * Routage du caca.
 */
class Router
{
    static private
        $VALID_ROUTES = [
            '01-aguicheur',
            '02-bateau-cool',
            '03-errorism',
            '04-naufrage',
            '05-conclusion',
            '06-editos',
        ]
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
        if (isset($_GET['p']) && in_array($requested_route, self::$VALID_ROUTES)) {
            $requested_route = $_GET['p'];
        }
        return $requested_route;
    }
}
