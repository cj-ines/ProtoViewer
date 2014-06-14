<?php
namespace Cuser\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class RegisterForm extends Form
{
	public function __construct($name = NULL)
	{
		parent::__construct();
		
		$this->setName($name);
		$this->setAttribute('method','POST');
		
		$this->add(array(
			'name' => 'username',
			'type' => 'Text',
			'attributes' => array(
				'required' => 'required',
				'class' => 'form-control',
				'placeholder' => 'Username',
			),
			'options' => array(
				//'label' => 'Username'
			),
		));
		
		$this->add(array(
			'name' => 'password',
			'type' => 'Password',
			'attributes' => array(
				'required' => 'required',
				'class' => 'form-control',
				'placeholder' => 'Password',
			),
			'options' => array(
				//'label' => 'Password'
			),
		));

		$this->add(array(
			'name' => 'email',
			'type' => 'Email',
			'attributes' => array(
				'required' => 'required',
				'class' => 'form-control',
				'placeholder' => 'Email',
			),
			'options' => array(
				//'label' => 'Username'
			),
		));
		
		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
			'attributes' => array(
				'class' => 'btn btn-primary',
				'value'=> 'Register'
			),
		));
		
	}
}