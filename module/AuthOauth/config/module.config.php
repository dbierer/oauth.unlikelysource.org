<?php
use Zend\Router\Http\Literal;
use Zend\Router\Http\Segment;

return [
    'router' => [
        'routes' => [
            'auth-oauth' => [
                'type'    => Segment::class,
                'options' => [
                    'route'    => '/oauth[/:action]',
                    'defaults' => [
                        'controller' => 'auth-oauth-index-controller',
                        'action'     => 'index',
                    ],
                ],
            ],
        ],
    ],
    'controllers' => [
        'factories' => [
            'auth-oauth-index-controller' => 'AuthOauth\Factory\IndexControllerFactory',
        ],
    ],
    'view_manager' => [
        'template_path_stack' => [__DIR__ . '/../view'],
    ],
    'service_manager' => [
        'services' => [
            // override this in /config/autoload/auth-oauth.local.php
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
];
