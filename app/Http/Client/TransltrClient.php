<?php
namespace App\Http\Client;


use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;

class TransltrClient
{
    const API_ENDPOINT = 'http://www.transltr.org/api/translate?';

    /**
     * @param string $word
     * @return array
     */
    static public function transalte(string $word, string $from, string $to) : array
    {
        $client   = new Client();

        $response = $client->send(
            new Request('GET', self::buildQuery($word, $from, $to))
        );

        return json_decode($response->getBody()->getContents(), true);
    }

    /**
     * @param string $word
     * @param string $from
     * @param string $to
     *
     * @return string
     */
    private static function buildQuery(string $word, string $from, string $to
    ): string
    {
        return self::API_ENDPOINT
            . 'text=' . $word
            . '&to=' . $to
            . '&from='. $from
            ;
    }
}
