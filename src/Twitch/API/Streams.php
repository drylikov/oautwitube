<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 26.07.2018
 * Time: 18:19.
 */

namespace densul\oautwitube\twitch\API;

class Streams extends BaseApi
{
    public function getStreamsInGame($game, $language): ?array
    {
        $parameters = [
            'query' => [
                'client_id'     => config('oautwitube-api.Twitch.client_id'),
                'client_secret' => config('oautwitube-api.Twitch.client_secret'),
                'language'      => $language,
                'game'          => $game,
                'stream_type'   => 'live',
            ],
        ];

        $url = config('oautwitube-api.Twitch.api_url').'/kraken/streams/';
        $response = $this->createRequest('GET', $url, null, $parameters);
        $response = json_decode($response->getBody()->getContents(), true);

        return $response;
    }
}
