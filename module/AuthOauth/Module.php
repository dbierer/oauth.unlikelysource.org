<?php
namespace AuthOauth;

use Laminas\Mvc\MvcEvent;
use AuthOauth\Generic\Hydrator;
use AuthOauth\Adapter\GoogleAdapter;

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
            'Laminas\Loader\StandardAutoloader' => [
                'namespaces' => [__NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__]
            ],
        ];
    }        
    public function getServiceConfig()
    {
        return [
            'factories' => [
                'auth-oauth-hydrator' => 'AuthOauth\Factory\AdapterAbstractFactory',
                'auth-oauth-provider-list' => function ($sm) {
                    return array_combine(array_keys($sm->get('auth-oauth-config')),
                                         array_keys($sm->get('auth-oauth-config')));
                },
            ],
            // 2016-06-21 DB ***********************************************************************************
            // use this as a fallback if you don't want to create 'auth-oauth-adapter-*' factories (as above)
            // Need to have config == $sm->get('auth-oauth-config')[$provider]
            // Also need to have a class AuthOauth\Adapter\{$provider}Adapter
            'abstract_factories' => [
                'auth-oauth-abstract-adapter-factory' => 'AuthOauth\Factory\AdapterAbstractFactory',
            ],
        ];
    }
}
