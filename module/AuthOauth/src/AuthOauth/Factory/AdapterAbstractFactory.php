<?php
// 2016-06-21 DB ***********************************************************************************
namespace AuthOauth\Factory;

use Exception;
use Interop\Container\ContainerInterface;
// ZF 2.4
// use Laminas\ServiceManager\AbstractFactoryInterface;
// ZF 3
use Laminas\ServiceManager\Factory\AbstractFactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;

class AdapterAbstractFactory implements AbstractFactoryInterface
{
    
    const ERROR_NO_CONFIG = 'ERROR: no configuration for this provider ';
    
    // ZF 3
    public function canCreate(ContainerInterface $container, $requestedName)
    {
        return $this->canCreateServiceWithName($container, NULL, $requestedName);
    }

    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return $this->createServiceWithName($container, NULL, $requestedName);
    }
    // ZF 2.4 and below
    public function canCreateServiceWithName(
                            ServiceLocatorInterface $sm, 
                            $name, 
                            $requestedName) 
    {
        return (fnmatch('auth-oauth-adapter-*', $requestedName)) ? TRUE : FALSE;
    } 
    public function createServiceWithName(
                            ServiceLocatorInterface $sm, 
                            $name, 
                            $requestedName) 
    {
        $breakdown = explode('-', $requestedName);
        $provider  = array_pop($breakdown);
        //                     return new GoogleAdapter($sm->get('auth-oauth-config')['google']);
        $className = 'AuthOauth\\Adapter\\' . ucfirst($provider) . 'Adapter';
        $config    = $sm->get('auth-oauth-config');
        if (!isset($config[$provider])) {
            $message = self::ERROR_NO_CONFIG . $provider;
            error_log(date('Y-m-d H:i:s') . ':' . __METHOD__ . ':' . $message);
            throw new Exception($message);
        }
        $adapter = new $className($config[$provider]);
        $adapter->setUserEntity($sm->get('auth-oauth-user-entity'));
        $adapter->setUserHydrator($sm->get('auth-oauth-user-hydrator'));
        $adapter->setAuthService($sm->get('auth-oauth-service'));
        return $adapter;
    }
}
