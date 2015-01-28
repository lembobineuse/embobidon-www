<?php

namespace Embo;


class Session
{
    static private
        $DEFAULT_LANG = 'fr',
        $ACCEPT_LANG = [
            'fr', 'en', 'ja'
        ]
    ;
    private
        $lang = 'fr'
    ;

    public function __construct()
    {
        session_start();
        $this->lang = $this->getLanguageFromGlobals();
    }
    
    public function getLanguage()
    {
        return $this->lang;
    }

    public function getDefaultLanguage()
    {
        $locale = \Locale::acceptFromHttp($_SERVER['HTTP_ACCEPT_LANGUAGE']); 
        if (!$locale) {
            return self::$DEFAULT_LANG;
        }
        $locale = explode('_', $locale)[0];
        if (!in_array($locale, self::$ACCEPT_LANG)) {
            return self::$DEFAULT_LANG;
        }
        return $locale;
    }

    private function getLanguageFromGlobals()
    {
        $lang = $this->getDefaultLanguage();
        if (isset($_GET['lang']) && in_array($_GET['lang'], self::$ACCEPT_LANG)) {
            $lang = $_GET['lang'];
            $_SESSION['lang'] = $lang;
            setcookie('lang', $lang, time() + (3600 * 24 * 30));
        } elseif (isset($_SESSION['lang'])) {
            $lang = $_SESSION['lang'];
        } elseif (isset($_COOKIE['lang'])) {
            $lang = $_COOKIE['lang'];
        }
        
        return $lang;
    }
    
}
