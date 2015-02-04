<?php
/* purge.php
 * Purge an url on this host
 */
header("Cache-Control: max-age=1"); // don't cache ourself
 
error_reporting(E_ALL);
ini_set("display_errors", 1);
 
// Set to true to hide varnish result
define("SILENT", false);

function purge ($url)
{
    if ( $ch = curl_init($url) ) {
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PURGE");
        curl_setopt($ch, CURLOPT_IPRESOLVE, CURL_IPRESOLVE_V4);
        curl_setopt($ch, CURLOPT_NOBODY, SILENT);
     
        curl_exec($ch);
        curl_close($ch);
    }
}

 
$path = isset($_GET["path"]) ? $_GET["path"] : "";
 
$pages = [
    '',
    '/donum-apello/',
    '/historia/01-bateau-cool/',
    '/historia/02-errorism/',
    '/historia/03-naufrage/',
    '/historia/04-odyssey-continues/',
    '/decennium/editos/',
    '/decennium/posters/',
    '/campaign_stats/'
];
$locales = ['fr', 'en', 'ja'];

purge('http://lembobineuse.biz/don/');
foreach ($locales as $locale) {
    foreach ($pages as $page) {
        $url = 'http://lembobineuse.biz/don/'.$locale.'/'.$page;
        purge($url);
    }
}
?>
