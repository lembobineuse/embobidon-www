<?php

namespace Embobidon\Service;


/**
 * Class CampaignStatsService
 * @author ju1ius
 */
class CampaignStatsService
{
    const CAMPAIGN_URL = 'http://www.helloasso.com/associations/l-embobineuse/collectes/embobidon';

    /**
     * Returns an array representing the remaining time of the campaign.
     *
     * <code>
     * [
     *      'days' => (int) remaining number of days,
     *      'hours' => (int) remaining number of hours
     * ]
     * </code>
     *
     * @return array 
     */
    public function getTimeLeft()
    {
        $end = new \DateTime('2015-03-11');
        $now = new \DateTime();
        $diff = $now->diff($end);

        return [
            'days' => $diff->days,
            'hours' => $diff->h + ($diff->days * 24)
        ];
    }

    public function fetchStats()
    {
        $content = self::fetchURL(self::CAMPAIGN_URL);

        $dom = new \DOMDocument();
        // Suppress warnings caused by HTML5 elements
        libxml_use_internal_errors(true);
        $dom->loadHTML($content, defined('LIBXML_COMPACT') ? LIBXML_COMPACT : 0);
        libxml_clear_errors();
        libxml_use_internal_errors(false);

        $xpath = new \DOMXPath($dom);
        $stats = [
            'amount' => null,
            'contributors' => null
        ];

        $nodes = $xpath->query('//*[@id="collecteMoney"]');
        if ($nodes->length) {
            $stats['amount'] = trim($nodes->item(0)->nodeValue);
        }
        $nodes = $xpath->query('//*[@id="nbDonateurs"]');
        if ($nodes->length) {
            $stats['contributors'] = trim($nodes->item(0)->nodeValue);
        }

        return $stats;
    }
    
    private static function fetchURL($url)
    {
        $options = [
            CURLOPT_URL             => $url, 
            CURLOPT_RETURNTRANSFER  => true,
            CURLOPT_HEADER          => false,
            CURLOPT_FAILONERROR     => true
        ];
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $body = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new \RuntimeException(sprintf(
                'Error fetching %s => %s',
                $url,
                curl_error($curl)
            ));
        }
        curl_close($curl);
        
        return $body;
    }
}
