<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 22.04.18
 * Time: 14:12.
 */

namespace densul\oautwitube\twitch\API;

use GuzzleHttp\Client;

class Authentication extends BaseApi
{
    /**
     * @return string
     */
    public function authenticationURL(): string
    {
        $clientId = config('oautwitube-api.Twitch.client_id');
        $scopes = implode('+', config('oautwitube-api.Twitch.scopes'));
        $redirectURL = url(config('oautwitube-api.Twitch.redirect_url'));

        return config('oautwitube-api.Twitch.api_url').'/kraken/oauth2/authorize?response_type=code&client_id='.$clientId.'&redirect_uri='.$redirectURL.'&scope='.$scopes;
    }

    /**
     * @param $code
     *
     * @throws \Exception
     *
     * @return mixed
     */
    public function requestToken($code): ?string
    {
        $parameters = [
            'client_id'     => config('oautwitube-api.Twitch.client_id'),
            'client_secret' => config('oautwitube-api.Twitch.client_secret'),
            'redirect_uri'  => config('oautwitube-api.Twitch.redirect_url'),
            'code'          => $code,
            'grant_type'    => 'authorization_code',
        ];

        try {
            $client = new Client();

            $response = $client->post(config('oautwitube-api.Twitch.api_url').'/kraken/oauth2/token', ['form_params' => $parameters]);
            $response = json_decode($response->getBody()->getContents(), true);

            if (isset($response['access_token'])) {
                return $response['access_token'];
            }
        } catch (\Exception $e) {
            throw $e;
        }
    }
}
