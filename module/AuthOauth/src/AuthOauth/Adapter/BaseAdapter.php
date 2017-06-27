<?php
namespace AuthOauth\Adapter;

use Exception;
use Zend\Authentication\Adapter\AbstractAdapter;

abstract class BaseAdapter extends AbstractAdapter
{
    const SUCCESS_AUTH = 'SUCCESS: authentication was successful';
    const ERROR_AUTH = 'ERROR: authentication failure';
    const ERROR_UNKNOWN = 'ERROR: unknown: ';
    const ERROR_INVALID_STATE = 'ERROR: invalid state: ';
    const ERROR_SOMETHING_WRONG = 'ERROR: something went wrong: ';
    const ERROR_NO_RESPONSE = 'ERROR: no response';
    
    protected $userEntity;
    protected $userHydrator;
    protected $authService;
    
    public function setUserEntity($entity)
    {
        $this->userEntity = $entity;
    }
    public function setUserHydrator($hydrator)
    {
        $this->userHydrator = $hydrator;
    }
    public function getUserEntity()
    {
        return $this->userEntity;
    }
    public function getUserHydrator()
    {
        return $this->userHydrator;
    }
    public function setAuthService($service)
    {
        $this->authService = $service;
    }
    public function getAuthService()
    {
        return $this->authService;
    }
}
