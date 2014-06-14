<?php
namespace CuserDoctrine\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

use DoctrineModule\Stdlib\Hydrator\DoctrineObject;


class AdminController extends AbstractActionController
{
	private $emgr;

	public function indexAction()
	{
		$em = $this->getEntityManager();
		$user = new \CuserDoctrine\Entity\User();
		//$user = new User();
		$user->setFullName('Marco Pivetta');
		$em->persist($user);

		$address = new \CuserDoctrine\Entity\Address();
		$address->setCity('Frankfurt');
		$address->setCountry('Germany');
		$em->persist($address);

		$project = new \CuserDoctrine\Entity\Project();
		$project->setName('Doctrine ORM');
		$em->persist($project);

		$user->setAddress($address);
		$user->getProjects()->add($project);
		$em->flush();

		$view = new ViewModel(array('user' => $user->getFullName()));
		return $view;
	}

	public function simpleAction()
	{
		$form = new \CuserDoctrine\Form\SimpleForm;
		$em = $this->getEntityManager();
		$request = $this->getRequest();
		
		if ($request->isPost()) {
			$hydrator = new DoctrineObject($em,'CuserDoctrine\Entity\User');
			$user = new \CuserDoctrine\Entity\User();
			$form->setData($request->getPost());
			$user->setFullName($form->get('fullName')->getValue());
			$em->persist($user);
			$em->flush();
			
			
		}
		$view = new ViewModel(array(
			'form' => $form,
		));
		return $view;
	}

	public function getEntityManager()
    {
    	if (!$this->emgr){
    		$this->emgr = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
    	}
    	return $this->emgr;
    }
}