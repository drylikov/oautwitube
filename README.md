# **_oautwitube_**
[![Latest Stable Version](https://poser.pugx.org/densul/oautwitube/version)](https://packagist.org/packages/densul/oautwitube)
[![Total Downloads](https://poser.pugx.org/densul/oautwitube/downloads)](https://packagist.org/packages/densul/oautwitube)[![Latest Unstable Version](https://poser.pugx.org/densul/oautwitube/v/unstable)](//packagist.org/packages/densul/oautwitube)
[![License](https://poser.pugx.org/densul/oautwitube/license)](https://packagist.org/packages/densul/oautwitube)
[![composer.lock available](https://poser.pugx.org/densul/oautwitube/composerlock)](https://packagist.org/packages/densul/oautwitube)

Данный пакет предназначен для laravel 5.6+, для работы с API youtube.com и twitch.tv.
В данное время доступна только oAuth авторизация и получение информации о текущем пользователе с этих ресурсов. 

UPD: 23.07.2018 добавлена возможность авторизации по Steam.
English soon

# **_Установка_**

```
composer require densul/oautwitube
```

Затем добавить в файле `config/app.php`, добавить сервис-провайдер

```PHP
densul\oautwitube\Providers\OautwitubeServiceProvider::class
```

Там же задать алиас:

```PHP
'Twitube' => densul\oautwitube\Facades\OautwitubeServiceFacade::class
```

Далее создаем конфиг:
```
php artisan vendor:publish
```
Выбираем наш сервис провайдер
После этого появится конфиг в `/config/oautwitube-api.php`

Для площадки youtube подтребуется включить API 3, [здесь](https://console.developers.google.com/apis/api/youtube.googleapis.com/).
Для площадки steam, ключ получаем тут [здесь](https://steamcommunity.com/dev/apikey).

# **_Использование_**

В шаблонизаторе:
```HTML
<div class="links">
    <a href="{{ Twitube::driver('twitch')->AuthenticationURL() }}">Auth Twitch</a>
    <a href="{{ Twitube::driver('youtube')->AuthenticationURL() }}">Auth YouTube</a>
</div>
```
В случае стима, можно поставить кнопки уже с готовой ссылкой:
```HTML
{!!  Twitube::driver('steam')->loginButton('small') !!} 
{!!  Twitube::driver('steam')->loginButton('big') !!}

<!--- simple link ---!>
Twitube::driver('steam')->AuthenticationURL()
```

Соответственно какой Вы задатите redirect_url в конфиге, создаем роуты:

```PHP
Route::get('/auth', ['as' => 'auth', 'uses' => 'Auth\LoginController@twitchLogin']);
Route::get('/auth_youtube', ['as' => 'auth', 'uses' => 'Auth\LoginController@youtubeLogin']);
Route::get('/auth_steam', ['as' => 'auth', 'uses' => 'Auth\LoginController@steamLogin']);
```

В LoginController:
```PHP
public function twitchLogin(Request $request)
{

    $code  = $request->input('code');
    $token = Twitube::driver('twitch')->RequestToken($code);
    $user  = Twitube::driver('twitch')->AuthenticatedUser($token);

    dd($user);
}

public function youtubeLogin(Request $request)
{
    $code   = $request->input('code');
    $token  = Twitube::driver('youtube')->RequestToken($code);
    $user   = Twitube::driver('youtube')->AuthenticatedUser($token);
    dd($user);
}

public function steamLogin(Request $request)
{
    $user = Twitube::driver('steam')->authenticatedUser();
    dd($user);  
}
```

Пока все, функционал буду дописывать по мере необходимости, следите за обновлениями. 
