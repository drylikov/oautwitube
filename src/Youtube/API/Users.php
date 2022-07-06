<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 22.04.18
 * Time: 17:53.
 */

namespace densul\oautwitube\Youtube\API;

class Users extends BaseApi
{
    public function authenticatedUser($token = null)
    {
        $token = $this->getToken($token);

        $user = $this->client->get('https://www.googleapis.com/youtube/v3/channels?part=snippet&mine=true&access_token='.$token);

        return json_decode($user->getBody()->getContents(), true);
    }
}
