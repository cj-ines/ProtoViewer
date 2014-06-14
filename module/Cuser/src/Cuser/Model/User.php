<?php
namespace Cuser\Model;

class User
{
	public $id;
	public $username;
	public $password;
	public $email;
	public $active;
	public $type;
	
	public function exchangeArray($data)
	{
		$this->id		= (isset($data['id'])) ? $data['id'] : null;
		$this->username = (isset($data['username'])) ? $data['username'] : null;
		$this->password = (isset($data['password'])) ? $data['password'] : null;
		$this->email 	= (isset($data['email'])) ? $data['email'] : null;
		$this->active	= (isset($data['active'])) ? $data['active'] : null;
		$this->type		= (isset($data['type'])) ? $data['type'] : null;
	}
	
	public function getArrayCopy()
	{
		return get_object_vars($this);
	}
}