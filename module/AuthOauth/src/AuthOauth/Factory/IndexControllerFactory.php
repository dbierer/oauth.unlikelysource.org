<?php

namespace AuthOauth\Factory;

use AuthOauth\Adapter\GoogleAdapter;
use AuthOauth\Controller\IndexController;
use Laminas\Authentication\AuthenticationService;
use Laminas\ServiceManager\ServiceLocatorInterface;

// needed for ZF 2.4
//  use Laminas\ServiceManager\FactoryInterface;

// needed for ZF3
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

class IndexControllerFactory implements FactoryInterface
{
    // needed for ZF 2.4
    /*
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $sm = $controllerManager->getServiceLocator();
        return $this->getController($sm);
    }
    */
    // needed for ZF3
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        return $this->getController($container);
    }
    private function getController($manager)
    {
        $controller = new IndexController();
        $controller->setAuthService($manager->get('auth-oauth-service'));
        $controller->setAuthAdapterGoogle($manager->get('auth-oauth-adapter-google'));
        return $controller;
    }
}
