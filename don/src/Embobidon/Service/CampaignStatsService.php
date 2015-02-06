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
        $xpath = self::getXPath($content);

        $stats = [
            'amount' => self::extractAmount($xpath),
            'contributors' => self::extractContributors($xpath),
            'comments' => self::extractComments($xpath)
        ];

        return $stats;
    }

    public function fetchComments()
    {
        $content = self::fetchURL(self::CAMPAIGN_URL);
        $xpath = self::getXPath($content);
        
        return self::extractComments($xpath);
    }

    private static function getXPath($source)
    {
        $dom = new \DOMDocument();
        // Suppress warnings caused by HTML5 elements
        libxml_use_internal_errors(true);
        $dom->loadHTML($source, defined('LIBXML_COMPACT') ? LIBXML_COMPACT : 0);
        libxml_clear_errors();
        libxml_use_internal_errors(false);

        return new \DOMXPath($dom);
    }

    private static function extractAmount(\DOMXPath $xpath)
    {
        $nodes = $xpath->query('//*[@id="collecteMoney"]');
        if ($nodes->length) {
            return trim($nodes->item(0)->nodeValue);
        }
    }

    private static function extractContributors(\DOMXPath $xpath)
    {
        $nodes = $xpath->query('//*[@id="nbDonateurs"]');
        if ($nodes->length) {
            return trim($nodes->item(0)->nodeValue);
        }
    }

    private static function extractComments(\DOMXPath $xpath)
    {
        $contributors = [];
        $nodes = $xpath->query('//*[@class="comment"]');
        for ($i = 0, $l = $nodes->length; $i < $l; $i++) {
            $contributor = [
                'name' => null,
                'donation' => null,
                'comment' => null
            ];
            $node = $nodes->item($i);
            $name_nodes = $xpath->query('./*[@class="name"]', $node);
            if ($name_nodes->length) {
                $contributor['name'] = trim($name_nodes->item(0)->nodeValue);
            }
            $donation_nodes = $xpath->query('./*[@class="don"]', $node);
            if ($donation_nodes->length) {
                $contributor['donation'] = trim($donation_nodes->item(0)->nodeValue);
            }
            $comment_nodes = $xpath->query('./*[@class="content"]', $node);
            if ($comment_nodes->length) {
                $contributor['comment'] = trim($comment_nodes->item(0)->nodeValue);
            }
            $contributors[] = $contributor;
        }

        return $contributors;
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
