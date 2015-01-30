<?php

namespace Embobidon\Service;


/**
 * Class CampaignStatsService
 * @author ju1ius
 */
class CampaignStatsService
{
    const YQL_QUERY = "https://query.yahooapis.com/v1/public/yql?q=SELECT%20*%20FROM%20data.html.cssselect%20WHERE%20url%3D'http%3A%2F%2Fwww.helloasso.com%2Fassociations%2Fl-embobineuse%2Fcollectes%2Fembobidon'%20AND%20css%3D'%23collecteMoney'&format=json&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";

    /**
     * Returns a DateInterval between now and the end of the campaign.
     *
     * @return DateInterval
     */
    public function getTimeLeft()
    {
        $end = new \DateTime('2015-03-10');
        $now = new \DateTime();
        return $end->diff($now);
    }

    public function fetchStats()
    {
        $endpoint = "https://query.yahooapis.com/v1/public/yql?q=SELECT%20*%20FROM%20data.html.cssselect%20WHERE%20url%3D'http%3A%2F%2Fwww.helloasso.com%2Fassociations%2Fl-embobineuse%2Fcollectes%2Fembobidon'%20AND%20css%3D'%23collecteMoney%2C%20%23nbDonateurs'&env=store%3A%2F%2Fdatatables.org%2Falltableswithkeys";
        // Tableau contenant les options de téléchargement
        $options = [
            CURLOPT_URL            => $endpoint, 
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false
        ];
        $curl = curl_init();
        curl_setopt_array($curl, $options);
        $content = curl_exec($curl);
        if (curl_errno($curl)) {
            throw new \Exception('Could not fetch stats from YQL API');
        }
        curl_close($curl);

        $dom = new \DOMDocument();
        $dom->loadXML($content);
        $xpath = new \DOMXPath($dom);

        $results = $xpath->query('/query/results/results');
        if (!$results->length) {
            throw new \Exception('YQL query returned no results');
        }

        $stats = [
            'amount' => null,
            'number' => null
        ];
        $nodes = $xpath->query('//div[@id="collecteMoney"]/p');
        if ($nodes->length) {
            $stats['amount'] = $nodes->item(0)->nodeValue;
        }
        $nodes = $xpath->query('//div[@id="nbDonateurs"]/p');
        if ($nodes->length) {
            $stats['number'] = $nodes->item(0)->nodeValue;
        }

        return $stats;
    }
}

