<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Cuser for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cuser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class AdminController extends AbstractActionController
{
    private $userTable;
    private $authService;
	
	public function indexAction()
    {
		$auth = $this->getAuthService();
    	$users = $this->getUserTable()->fetchAll(true);
        $users->setCurrentPageNumber((int)$this->params()->fromQuery('page',1));
        $users->setItemCountPerPage(10);
		$view = new ViewModel(array('users' => $users));
        $userTableView = new ViewModel(array('users' => $users));
        $userTableView->setTemplate('cuser/admin/parts/user-table');
        $view->addChild($userTableView,'usertable');
		return $view;
    }

    public function fooAction()
    {
        // This shows the :controller and :action parameters in default route
        // are working when you browse to /admin/admin/foo
        return array();
    }
    
    public function getUserTable(){
    	if (!$this->userTable) {
    		$this->userTable = $this->getServiceLocator()->get('Cuser\Model\UserTable');
    	}
		return $this->userTable;    	
    }
    
    public function getAuthService()
    {
    	if (!$this->authService){
    		$this->authService = $this->getServiceLocator()->get('AuthService');
    	}
    	return $this->authService;
    }
}
