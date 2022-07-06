<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 23.07.2018
 * Time: 11:31.
 */

namespace densul\oautwitube\Services;

use densul\oautwitube\steam\API\Authentication;
use densul\oautwitube\steam\API\Users;

class SteamApiService
{
    /**
     * @return string
     */
    public function AuthenticationURL()
    {
        $authenticationAPI = new Authentication();

        return $authenticationAPI->authenticationURL();
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function loginButton($type = 'small')
    {
        $loginButtonAPI = new Authentication();

        return $loginButtonAPI->loginButton($type);
    }

    /**
     * @param null $token
     *
     * @return \densul\oautwitube\twitch\API\json
     */
    public function AuthenticatedUser($token = null)
    {
        $usersAPI = new Users();

        return $usersAPI->authenticatedUser();
    }
}
