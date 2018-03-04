<?php
/**
 * Created by PhpStorm.
 * User: Lukas Figura
 * Date: 02.10.16
 * Time: 11:00
 */

namespace App\_Classes;

use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

class RequestService
{

    /**
     * Send an async request
     *
     * @param String $type    Type of request
     * @param String $url     URL of request
     * @param String $content Content of sended request
     */
    public function sendAsyncRequest($type, $url, $content)
    {
        $client = new Client();

        $promise = $client->requestAsync($type, $url, [
            'json' => $content
        ]);

        $promise->then(
            function (ResponseInterface $res) {
                echo $res->getStatusCode()."\n";
            },
            function (RequestException $e) {
                echo $e->getMessage()."\n";
                echo $e->getRequest()->getMethod();
            }
        );
    }

    /**
     * Send an sync request
     *
     * @param String $type    Type of request
     * @param String $url     URL of request
     * @param String $content Content of sended request
     */
    public function sendRequest($type, $url, $content)
    {
        try {
            $client = new Client();

            $result = $client->request($type, $url, [
                'json' => $content
            ]);

            return $result->getBody();
        } catch (Exception $e) {
            return false;
        }
    }
}