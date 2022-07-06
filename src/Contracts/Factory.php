<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 23.07.2018
 * Time: 9:46.
 */

namespace densul\oautwitube\Contracts;

interface Factory
{
    public function driver($driver = null);
}
