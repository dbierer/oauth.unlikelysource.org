<?php
namespace AuthOauth\Factory;

use Zend\Authentication\AuthenticationService;
// needed for ZF3
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class AuthServiceFactory implements FactoryInterface
{
    // needed for ZF 2.4
    /*
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        return new AuthenticationService();
    }
    */
    // needed for ZF3
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        return $this->getService($container);
    }
    private function getService($manager)
    {
        return new AuthenticationService();
    }
}
