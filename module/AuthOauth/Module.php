<?php
namespace AuthOauth;

use Zend\Mvc\MvcEvent;
use AuthOauth\Adapter\GoogleAdapter;
use Zend\Authentication\AuthenticationService;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        if (session_status() != PHP_SESSION_ACTIVE) session_start();
    }
    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
    public function getAutoloaderConfig()
    {
        return [
            'Zend\Loader\StandardAutoloader' => [
                'namespaces' => [__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__]
            ],
        ];
    }        
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'auth-oauth-service' => function ($sm) {
                    return new AuthenticationService();
                },
                'auth-oauth-adapter-google' => function ($sm) {
                    return new GoogleAdapter($sm->get('auth-oauth-config')['google']);
                },
            ],
        ];
    }
}
