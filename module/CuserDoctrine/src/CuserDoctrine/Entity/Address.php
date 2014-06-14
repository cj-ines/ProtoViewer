<?php
namespace CuserDoctrine\Entity;

use Doctrine\ORM\Mapping as ORM;

/** @ORM\Entity */
class Address {
    
    /**
	* @ORM\Id
	* @ORM\GeneratedValue(strategy="AUTO")
	* @ORM\Column(type="integer")
	*/

    protected $id;

    /** @ORM\Column(type="string") */
    protected $city;

    /** @ORM\Column(type="string") */
    protected $country;

    // getters/setters etc.
    public function setId($value)
	{
		$this->id = $value;
	}
	
	public function getId() 
	{
		return $this->id;
	}
	
    public function setCity($val)
    {
    	$this->city = $val;
    }
    public function setCountry($val)
    {
    	$this->country = $val;
    }

    public function getCity()
    {
    	return $this->city;
    }

    public function getCountry()
    {
    	return $this->country;
    }
}