<?php
namespace Cuser\Form;

use Zend\InputFilter\InputFilter;

class LoginFilter extends InputFilter 
{
	public function __construct()
	{
		$this->add(array(
			'name' => 'username',
			'required' => true,
			'filters' => array(
				array('name' => 'StripTags'),
				array('name' => 'StringTrim'),
			),
			'validators' => array(
				array(
					'name' => 'StringLength',
						'options' => array(
							'encoding' => 'UTF-8',
							'min' => 3,
							'max' => 50,
					),
				),
			),
		));
		
		
	}
}