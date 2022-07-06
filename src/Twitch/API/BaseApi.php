<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 22.04.18
 * Time: 14:02.
 */

namespace densul\oautwitube\twitch\API;

use GuzzleHttp\Client;

class BaseApi
{
    /** @var null */
    protected $token;
    /** @var GuzzleClient */
    protected $client;

    /**
     * BaseApi constructor.
     *
     * @param null $token
     */
    public function __construct($token = null)
    {
        if ($token) {
            $this->setToken($token);
        }

        $this->client = new Client([
            'base_url'  => config('oautwitube-api.Twitch.api_url'), // not working, suka bleat
            'defaults'  => [
                'headers' => ['Accept' => 'application/vnd.twitchtv[v3]+json'],
            ],
        ]);
    }

    /**
     * @return string|null
     */
    public function getToken($token = null): ?string
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
     * @param $params
     *
     * @return \GuzzleHttp\Message\Request|\GuzzleHttp\Message\RequestInterface
     */
    protected function createRequest($type, $url, $token = null, $params = [])
    {
        $headers = $this->getDefaultHeaders($token, $params);

        return $this->client->request($type, $url, $headers);
    }

    /**
     * @param null  $token
     * @param array $params
     *
     * @return array
     */
    protected function getDefaultHeaders($token = null, $params = [])
    {
        $headers = [
            'headers' => [
                'Accept' => 'application/vnd.twitchtv.v3+json',
            ],
        ];

        if ($token != null) {
            $headers['headers']['Authorization'] = 'OAuth '.$token;
        }

        if (config('oautwitube-api.Twitch.client_id')) {
            $headers['headers']['Client-ID'] = config('oautwitube-api.Twitch.client_id');
        }

        if ($params) {
            $headers = array_merge($headers, $params);
        }

        return $headers;
    }
}
