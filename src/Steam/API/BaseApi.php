<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 23.07.2018
 * Time: 11:19.
 */

namespace densul\oautwitube\steam\API;

use GuzzleHttp\Client;

class BaseApi
{
    /** @var GuzzleClient */
    protected $client;
    /** @var string */
    const OPENID_STEAM = 'https://steamcommunity.com/openid/login';
    /** @var string */
    const OPENID_SPECS = 'http://specs.openid.net/auth/2.0';
    /** @var string */
    const OPENID_URL = 'https://steamcommunity.com/openid/login';

    /**
     * BaseApi constructor.
     *
     * @param Request $request
     */
    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * @param $type
     * @param $url
     * @param data
     *
     * @return \GuzzleHttp\Message\Request|\GuzzleHttp\Message\RequestInterface
     */
    protected function createRequest($type, $url, $data = [])
    {
        return $this->client->request($type, $url, $data);
    }
}
