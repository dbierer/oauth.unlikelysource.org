# AuthOauth Module

Last Rev: 5 Jun 2017

Integrates Oauth2 clients from the PHP League into ZF2

See: [https://github.com/thephpleague/oauth2-client](https://github.com/thephpleague/oauth2-client) for more information

## Currently supported providers:

[https://github.com/thephpleague/oauth2-client/blob/master/docs/providers/league.md](https://github.com/thephpleague/oauth2-client/blob/master/docs/providers/league.md)
[https://github.com/thephpleague/oauth2-client/blob/master/docs/providers/thirdparty.md](https://github.com/thephpleague/oauth2-client/blob/master/docs/providers/thirdparty.md)

## How to add additional providers

Example given is using the Google provider

* Create an adapter under AuthOauth\Adapter\* which implements the logic for this provider.
```
<?php
namespace AuthOauth\Adapter;

use Zend\Authentication\Result;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Adapter\AbstractAdapter;
use League\OAuth2\Client\Provider\Google as GoogleProvider;

class GoogleAdapter extends AbstractAdapter
{
    /**
     * Authenticate using logic provided by the PHP League Google Client docs
     *
     * @param Zend\Authentication\AuthenticationService $service | NULL
     * @return Result The authentication result
     * @throws RuntimeException
     */
    public function authenticate(AuthenticationService $service = NULL)
    {
        // etc.
        
    }
    // etc.
}
```

* Update the ```autoload_classmap.php``` file:
```
cd /path/to/app/module/Auth/Oauth
php /path/to/vendor/bin/classmap_generator.php
```

* Add configuration for the new provider in AuthOauth/config/module.config.php or in /config/autoload/authoauth.local.php
```
'service_manager' => [
    'services' => [
        'auth-oauth-config' => [
            'google' => [
                'clientId'     => 'client.id.from.apps.googleusercontent.com',
                'clientSecret' => 'client.secret.apps.googleusercontent.com',
                'redirectUri'  => 'http://oauth.unlikelysource.org/oauth/google',
                'hostedDomain' => 'http://oauth.unlikelysource.org',
            ],
        ],
    ],
],
```

* Add a Service Manager service for the provider in ```Module.php```:
```
public function getServiceConfig()
{
    return [
        'factories' => [
            'auth-oauth-adapter-google' => function ($sm) {
                return new GoogleAdapter($sm->get('auth-oauth-config')['google']);
            },
            // etc.
        ],
    ];
}
```

* Add an action in ```IndexController.php```:
```
public function googleAction()
{
    // provide auth service argument to have authenticate() store identity
    $result = $this->authAdapterGoogle->authenticate($this->authService);
    $viewModel = new ViewModel(['action' => 'Google', 'result' => $result]);
    $viewModel->setTemplate('auth-oauth/index/result');
    return $viewModel;
}
```

* Add an entry on your ```composer.json``` file for the new provider:
```
"league/oauth2-google": "^2.0",
```

