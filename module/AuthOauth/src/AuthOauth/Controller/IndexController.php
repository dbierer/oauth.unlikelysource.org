<?php
/**
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2016 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace AuthOauth\Controller;

use AuthOauth\Adapter\GoogleAdapter;
use Zend\Authentication\AuthenticationService;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    protected $authAdapterGoogle;
    protected $authService;
    public function indexAction()
    {
        if ($this->authService->hasIdentity()) {
            $message = 'Login Identity:';
            $result = $this->authService->getIdentity();
        } else {
            $message = 'Login Failure';
            $result = NULL;
        }
        $viewModel = new ViewModel(['action' => $message, 'result' => $result]);
        $viewModel->setTemplate('auth-oauth/index/result');
        return $viewModel;
    }
    public function googleAction()
    {
        // provide auth service argument to have authenticate() store identity
        $result = $this->authAdapterGoogle->authenticate($this->authService);
        $viewModel = new ViewModel(['action' => 'Google', 'result' => $result]);
        $viewModel->setTemplate('auth-oauth/index/result');
        return $viewModel;
    }
    public function setAuthService(AuthenticationService $service)
    {
        $this->authService = $service;
    }
    public function setAuthAdapterGoogle(GoogleAdapter $adapter)
    {
        $this->authAdapterGoogle = $adapter;
    }
}
