<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 22.04.18
 * Time: 16:29.
 */

namespace densul\oautwitube\Youtube\API;

use GuzzleHttp\Client;

class BaseApi
{
    /** @var Client */
    protected $client;
    /** @var string */
    protected $token;

    public function __construct($token = null)
    {
        if ($token) {
            $this->setToken($token);
        }

        $this->client = new Client([
            'base_url'  => 'https://accounts.google.com/o/oauth2/v2/auth?',
            'defaults'  => [
                'headers' => ['Accept' => 'application/vnd.twitchtv[v3]+json'],
            ],
        ]);
    }

    /**
     * @return null|string
     */
    public function getToken($token = null)
    {
        if ($token) {
            $this->token = $token;
        }

        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken($token)
    {
        $this->token = $token;
    }

    /**
     * @param $type
     * @param $url
     * @param $token
     *
     * @return mixed
     */
    protected function createRequest($type, $url, $token)
    {
        return $this->client->createRequest($type, $url, $this->getDefaultHeaders($token));
    }

    /**
     * @param null $token
     *
     * @return array
     */
    protected function getDefaultHeaders($token = null)
    {
        $headers = [
            'headers' => [
                'Accept' => 'application/json',
            ],
        ];

        if ($token != null) {
            $headers['headers']['Authorization'] = 'Bearer '.$token;
        }

        return $headers;
    }
}
