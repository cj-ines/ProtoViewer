<?php
namespace CuserDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Project {
    
    /**
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer")
	*/
    protected $id;

    /** @ORM\Column(type="string") */
    protected $name;

    // getters/setters
    public function setId($value)
	{
		$this->id = $value;
	}
	
	public function getId() 
	{
		return $this->id;
	}

	public function setName($value)
	{
		$this->name = $value;
	}

	public function getName() 
	{
		return $this->name;
	}
}