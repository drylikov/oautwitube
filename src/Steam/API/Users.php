<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 23.07.2018
 * Time: 17:54.
 */

namespace densul\oautwitube\steam\API;

use Illuminate\Support\Fluent;
use Request;

class Users extends BaseApi
{
    /** @var int */
    public $steamId;
    /** @var SteamInfo */
    public $steamInfo;
    /** @var string */
    const STEAM_INFO_URL = 'http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=%s&steamids=%s';

    private function requestIsValid()
    {
        return Request::has('openid_assoc_handle')
            && Request::has('openid_signed')
            && Request::has('openid_sig');
    }

    public function validate()
    {
        if (! $this->requestIsValid()) {
            return false;
        }

        $params = $this->getParams();

        $response = $this->createRequest('POST', self::OPENID_URL, [
            'form_params' => $params,
        ]);
        $results = $this->parseResults($response->getBody()->getContents());

        $this->parseSteamID();
        $this->parseInfo();

        return $results->is_valid == 'true';
    }

    public function parseInfo()
    {
        if (is_null($this->steamId)) {
            return;
        }

        $reponse = $this->createRequest('GET', sprintf(self::STEAM_INFO_URL, config('oautwitube-api.Steam.api_key'), $this->steamId));
        $json = json_decode($reponse->getBody(), true);
        $this->steamInfo = new SteamInfo($json['response']['players'][0]);
    }

    public function parseSteamID()
    {
        preg_match('#^https?://steamcommunity.com/openid/id/([0-9]{17,25})#', Request::get('openid_claimed_id'), $matches);
        $this->steamId = is_numeric($matches[1]) ? $matches[1] : 0;
    }

    public function parseResults($results)
    {
        $parsed = [];
        $lines = explode("\n", $results);
        foreach ($lines as $line) {
            if (empty($line)) {
                continue;
            }
            $line = explode(':', $line, 2);
            $parsed[$line[0]] = $line[1];
        }

        return new Fluent($parsed);
    }

    public function getParams()
    {
        $params = [
            'openid.assoc_handle' => Request::get('openid_assoc_handle'),
            'openid.signed'       => Request::get('openid_signed'),
            'openid.sig'          => Request::get('openid_sig'),
            'openid.ns'           => 'http://specs.openid.net/auth/2.0',
            'openid.mode'         => 'check_authentication',
        ];

        $signedParams = explode(',', Request::get('openid_signed'));

        foreach ($signedParams as $item) {
            $value = Request::get('openid_'.str_replace('.', '_', $item));
            $params['openid.'.$item] = get_magic_quotes_gpc() ? stripslashes($value) : $value;
        }

        return $params;
    }

    /**
     * @return \densul\oautwitube\steam\API\SteamInfo
     */
    public function getUserInfo()
    {
        return $this->steamInfo;
    }

    /**
     * @return int
     */
    public function getSteamId()
    {
        return $this->steamId;
    }

    /**
     * @return mixed
     */
    public function authenticatedUser()
    {
        if ($this->validate()) {
            $info = $this->getUserInfo();

            return $info;
        }

        return false;
    }
}
