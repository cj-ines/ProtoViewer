<?php
namespace Cuser\Factory;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

class RegisterFormFactory implements FactoryInterface
{
	public function createService(ServiceLocatorInterface $sm)
	{
		$viewMmodel = new ViewModel(array(
			'hello' => 'world',
		));
		$viewMmodel->setLayout('admin/index.phtml');
		return $viewMmodel;
	}
}