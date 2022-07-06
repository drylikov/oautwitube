<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 22.04.18
 * Time: 17:20.
 */

namespace densul\oautwitube\Youtube\API;

class Authentication extends BaseApi
{
    public function authenticationURL()
    {
        $client_id = config('oautwitube-api.Youtube.client_id');
        $scopes = implode('+', config('oautwitube-api.Youtube.scopes'));
        $redirectURL = url(config('oautwitube-api.Youtube.redirect_url'));

        return 'https://accounts.google.com/o/oauth2/v2/auth?scope='.$scopes.'&access_type=offline&include_granted_scopes=true'.
        '&state=state_parameter_passthrough_value'.
        '&redirect_uri='.$redirectURL.'&response_type=code&client_id='.$client_id;
    }
}
