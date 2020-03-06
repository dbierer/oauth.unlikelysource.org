<?php
namespace AuthOauth\Factory;

use Laminas\Authentication\AuthenticationService;
// needed for ZF3
use Interop\Container\ContainerInterface;
use Laminas\ServiceManager\Factory\FactoryInterface;

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
