<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 23.07.2018
 * Time: 22:45.
 */

namespace densul\oautwitube\steam\API;

use Illuminate\Support\Fluent;

class SteamInfo extends Fluent
{
    public function __construct($data)
    {
        $steamID = isset($data['steamid']) ? $data['steamid'] : null;
        unset($data['steamid']);
        parent::__construct($data);
        $this->attributes['steamID64'] = $steamID;
    }
}
