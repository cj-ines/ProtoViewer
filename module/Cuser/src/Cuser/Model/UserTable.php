<?php

namespace Cuser\Model;

use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;
use Zend\Db\Sql\Select;
use Zend\Paginator\Adapter\DbSelect;
use Zend\Paginator\Paginator;


class UserTable
{
	protected $tableGateway;

	public function __construct(TableGateway $tableGateway)
	{
		$this->tableGateway = $tableGateway;
	}
	
	public function fetchAll($paginated = false)
	{
		if ($paginated) {
			$select = new select('Users');
			$resultSetPrototype = new ResultSet();
			$resultSetPrototype->setArrayObjectPrototype(new User());
			$PaginatorAdapter = new DbSelect (
				$select,
				$this->tableGateway->getAdapter(),
				$resultSetPrototype
			);
			$paginator = new Paginator($PaginatorAdapter);
			return $paginator;
		}
		$resultSet = $this->tableGateway->select();
		return $resultSet;
	}

	
	
	public function getUser($id)
	{
		$id  = (int) $id;
		$rowset = $this->tableGateway->select(array('id' => $id));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $id");
		}
		return $row;
	}
	public function getUserbyUsername($username) {
		$rowset = $this->tableGateway->select(array('username' => $username));
		$row = $rowset->current();
		if (!$row) {
			throw new \Exception("Could not find row $username");
		}
		return $row;
	}
	public function getUserbyType($type)
	{
		$type = (int) $type;
		$resultSet = $this->tableGateway->select(array('type' => $type));
		return $resultSet;
	}
}