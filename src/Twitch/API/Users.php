<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 22.04.18
 * Time: 14:26.
 */

namespace densul\oautwitube\twitch\API;

class Users extends BaseApi
{
    /**
     * @param $username
     *
     * @return array
     */
    public function user($username): array
    {
        $user = $this->client->get('https://api.Twitch.tv/kraken/users/'.$username);

        return json_decode($user->getBody()->getContents(), true);
    }

    /**
     * Authenticated, required scope: user_read.
     *
     * @param null $token
     *
     * @return array
     */
    public function authenticatedUser($token = null): array
    {
        $token = $this->getToken($token);
        $user = $this->client->get('https://api.Twitch.tv/kraken/user?oauth_token='.$token);

        return json_decode($user->getBody()->getContents(), true);
    }
}
