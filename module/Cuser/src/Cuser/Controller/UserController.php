<?php
namespace Cuser\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class UserController extends AbstractActionController
{
	private $userTable;
	private $authService;
	private $identity;
	
	public function indexAction()
	{
		//$this->redirect()->toRoute('cuser/user-login', array('action' => 'login'));
	}
	public function loginAction()
	{
		$form = $this->getServiceLocator()->get('Cuser\Form\LoginForm');
		$error = null;
		$request = $this->getRequest();
		if ($request->isPost()) {
			$post = $request->getPost();
			$form->setData($post);
			if (!$form->isValid()) {
				return new ViewModel(array('form' => $form, 'error' => $form->getMessages()));
			}
			
			$auth = $this->getAuthService()->getAdapter();
			$auth->setIdentity($post->username)->setCredential($post->password);
			$result = $this->getAuthService()->authenticate();
			if ($result->isValid()) {
				$this->getAuthService()->getStorage()->write($post->username);
				$this->identity = $this->getAuthService()->getStorage()->read();
			}
			else {
				return new ViewModel(array('form' => $form, 'error' => true));
			}
		}
		
		$view = new ViewModel(array(
			'form' => $form,
		));
		return $view;
	}

	public function registerAction()
	{
		$form = new \Cuser\Form\RegisterForm;
		$form->setInputFilter(new \Cuser\Form\RegisterFilter);

		$request = $this->getRequest();
		if ($request->isPost()) {
			$form->setData($request->getPost());
			if ($form->isValid()) {
				$user = $this->getUserTable();
				$em = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
				$usr = new \CuserDoctrine\Entity\User();
				$data = $form->getData();
				$usr->setFullName($data['email']);
				$em->persist($usr);
				$em->flush();
				var_dump($form->getData());
				//var_dump($user);
			}
		}
		$view = new ViewModel(array(
			'form' => $form,
		));
		return $view;
	}

	public function processAction()
	{
		
	}
	
	public function getUserTable()
	{
		if (!$this->userTable) {
			$this->userTable = $this->getServiceLocator()->get('Cuser\Model\UserTable');
		}	
		return $this->userTable;
	}
	
	public function getAuthService()
	{
		if (!$this->authService) {
			$this->authService = $this->getServiceLocator()->get('AuthService');
		}
		return $this->authService;
	}
}