<?php

namespace CuserDoctrine\Form;

use Zend\Form\Form;
use Zend\Form\Element;

class SimpleForm extends Form
{
	public function __construct() {
		parent::__construct();

		$this->setName('Simple');

		$this->add(array(
			'name' => 'fullName',
			'type' => 'Text',
			'options' => array(
				'label' =>'Full Name',
			),
		));

		$this->add(array(
			'name' => 'submit',
			'type' => 'Submit',
		));
	}
}