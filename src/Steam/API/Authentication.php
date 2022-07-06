<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 23.07.2018
 * Time: 11:25.
 */

namespace densul\oautwitube\steam\API;

use Request;

class Authentication extends BaseApi
{
    /**
     * @return string
     */
    public function authenticationURL(): string
    {
        $params = [
            'openid.ns'         => self::OPENID_SPECS,
            'openid.mode'       => 'checkid_setup',
            'openid.return_to'  => url(config('oautwitube-api.Steam.redirect_url')),
            'openid.realm'      => Request::getSchemeAndHttpHost(),
            'openid.identity'   => self::OPENID_SPECS.'/identifier_select',
            'openid.claimed_id' => self::OPENID_SPECS.'/identifier_select',
        ];

        return self::OPENID_STEAM.'?'.http_build_query($params);
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public function loginButton($type = 'small')
    {
        return sprintf('<a href="%s"><img src="%s" /></a>', $this->authenticationURL(), self::button($type));
    }

    /**
     * @param string $type
     *
     * @return string
     */
    public static function button($type = 'small')
    {
        return 'https://steamcommunity-a.akamaihd.net/public/images/signinthroughsteam/sits_0'.($type == 'small' ? 1 : 2).'.png';
    }
}
