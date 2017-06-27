<?php
namespace AuthOauth\Factory;

use AuthOauth\Generic\Hydrator;

// needed for ZF3
use Interop\Container\ContainerInterface;
use Zend\ServiceManager\Factory\FactoryInterface;

class HydratorFactory implements FactoryInterface
{
    // needed for ZF 2.4
    /*
    public function createService(ServiceLocatorInterface $controllerManager)
    {
        $sm = $controllerManager->getServiceLocator();
        return $this->getHydrator($sm);
    }
    */
    // needed for ZF3
    public function __invoke(ContainerInterface $container, $requestedName, ?array $options = NULL)
    {
        return $this->getHydrator($container);
    }
    private function getHydrator($manager)
    {
        $hydrator = new Hydrator();
        return $hydrator;
    }
}
