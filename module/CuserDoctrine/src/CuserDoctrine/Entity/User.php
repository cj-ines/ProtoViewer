<?php
namespace CuserDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;


/** @ORM\Entity */
class User
{
	/**
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer")
	*/
	protected $id;

	/** @ORM\Column(type="string") */
	protected $fullName;

	/** @ORM\ManyToOne(targetEntity="Address") */
    protected $address;

    /** @ORM\ManyToMany(targetEntity="Project") */
    protected $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

	//setters/getters
	public function setId($value)
	{
		$this->id = $value;
	}

	public function setFullName($value)
	{
		$this->fullName = $value;
	}

	public function setAddress($value)
	{
		$this->address = $value;
	}

	public function setProjects($value)
	{
		$this->projects = $value;
	}

	public function getId() 
	{
		return $this->id;
	}

	public function getFullName()
	{
		return $this->fullName;
	}

	public function getAddress()
	{
		return $this->address;
	}

	public function getProjects()
	{
		return $this->projects;
	}
}