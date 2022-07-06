<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 22.04.18
 * Time: 13:55.
 */

return [
    'Twitch'    => [
        'api_url'       => 'https://api.twitch.tv',
        'client_id'     => '',
        'client_secret' => '',
        'redirect_url'  => '',
        'scopes'        => [
            'user_read',
            //'user_blocks_edit',
            //'user_blocks_read',
            //'user_follows_edit',
            //'channel_read',
            //'channel_editor',
            //'channel_commercial',
            //'channel_stream',
            'channel_subscriptions',
            'user_subscriptions',
            'channel_check_subscription',
            'chat_login',
        ],
    ],
    'Youtube'   => [
        'clientId'     => '',
        'clientSecret' => '',
        'redirectUri'  => '',
        'scopes'       => [
            'https://www.googleapis.com/auth/youtube.readonly',
        ],
    ],
    'Steam' => [
        'api_key'      => '',
        'method'       => 'api',
        'timeout'      => 5,
        'universe'     => false,
        'redirect_url' => '/auth/steam',
    ],
];
