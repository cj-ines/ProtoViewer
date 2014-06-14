<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/Cuser for the canonical source repository
 * @copyright Copyright (c) 2005-2012 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Cuser;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;

use Zend\Authentication\Adapter\DbTable as DbTableAuthAdapter;
use Zend\Authentication\AuthenticationService;

class Module implements AutoloaderProviderInterface
{
    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\ClassMapAutoloader' => array(
                __DIR__ . '/autoload_classmap.php',
            ),
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
		    // if we're in a namespace deeper than one level we need to fix the \ in the path
                    __NAMESPACE__ => __DIR__ . '/src/' . str_replace('\\', '/' , __NAMESPACE__),
                ),
            ),
        );
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }
	
    public function getServiceConfig()
    {
    	return array(
    		'factories' => array(
    			'AuthService' => function($sm) {
    				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$dbTableAuthAdapter = new DbTableAuthAdapter($dbAdapter,'users','username','password');
    				$authService = new AuthenticationService();
    				$authService->setAdapter($dbTableAuthAdapter);
    				return $authService;
    			},
    			'MailService' => function($sm) {
    				$options = array(
    					'host' => 'smtp.gmail.com',
    					'port' => 587,
    					'connection_class' => 'login',
    					'connection_config' => array(
    						'username' => 'xdell.ines@gmail.com',
    						'password' => 'hl6en2he2ky',
    						'ssl' => 'tls'
    				));
    				$smtpOptions = new Transport\SmtpOptions($options);
    				$smtp = new Transport\Smtp($smtpOptions);
    				return $smtp;
    			},
    			// Database Tables
    			'Cuser\Model\UserTable' =>  function($sm) {
    				$tableGateway = $sm->get('UserTableGateway');
    				$table = new \Cuser\Model\UserTable($tableGateway);
    				return $table;
    			},
    			'UserTableGateway' => function ($sm) {
    				$dbAdapter = $sm->get('Zend\Db\Adapter\Adapter');
    				$resultSetPrototype = new ResultSet();
    				$resultSetPrototype->setArrayObjectPrototype(new \Cuser\Model\User());
    				return new TableGateway('users', $dbAdapter, null, $resultSetPrototype);
    			},
    			//Forms
    			'Cuser\Form\LoginForm' => function ($sm) {
    				$form = new \Cuser\Form\LoginForm();
    				$form->setInputFilter($sm->get('Cuser\Form\LoginFilter'));
    				return $form;
    			},
    			'Cuser\Form\LoginFilter' => function ($sm) {
    				return new \Cuser\Form\LoginFilter();
    			},
    		)
    	);	
    }
    
    public function onBootstrap(MvcEvent $e)
    {
        // You may not need to do this if you're doing it elsewhere in your
        // application
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }
}
