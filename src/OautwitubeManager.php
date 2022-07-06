<?php
/**
 * Created by PhpStorm.
 * User: mio
 * Date: 23.07.2018
 * Time: 9:31.
 */

namespace densul\oautwitube;

use densul\oautwitube\Services\SteamApiService;
use densul\oautwitube\Services\TwitchApiService;
use densul\oautwitube\Services\YoutubeApiService;
use Illuminate\Support\Manager;

class OautwitubeManager extends Manager implements Contracts\Factory
{
    public function with($driver)
    {
        return $this->driver($driver);
    }

    /**
     * @return TwitchApiService
     */
    protected function createTwitchDriver(): TwitchApiService
    {
        return new TwitchApiService();
    }

    /**
     * @return YoutubeApiService
     */
    protected function createYoutubeDriver(): SteamApiService
    {
        return new YoutubeApiService();
    }

    /**
     * @return SteamApiService
     */
    protected function createSteamDriver(): SteamApiService
    {
        return new SteamApiService();
    }

    /**
     * @throws \InvalidArgumentException
     *
     * @return string|void
     */
    public function getDefaultDriver(): void
    {
        throw new InvalidArgumentException('Не выбран никакой драйвер');
    }
}
