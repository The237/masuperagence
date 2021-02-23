<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;
use App\Entity\Property;


class Contact
{
    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2,max=100)
     */
    private $firstName;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2,max=100)
     */
    private $lastName;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=2,max=100)
     * @Assert\Regex(
     *     pattern="/[0-9]{9}/"
     * )
     */
    private $phone;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Email()
     */
    private $email;

    /**
     * @var string|null
     * @Assert\NotBlank()
     * @Assert\Length(min=10)
     */
    private $message;

    /**
     * @var Property|null
     */
    private $property;



    /**
     * Get the value of firstName
     *
     * @return  string|null
     */ 
    public function getFirstName()
    {
        return $this->firstName;
    }

    /**
     * Set the value of firstName
     *
     * @param  string|null  $firstName
     *
     * @return  self
     */ 
    public function setFirstName(string $firstName)
    {
        $this->firstName = $firstName;

        return $this;
    }

    /**
     * Get the value of lastName
     *
     * @return  string|null
     */ 
    public function getLastName()
    {
        return $this->lastName;
    }

    /**
     * Set the value of lastName
     *
     * @param  string|null  $lastName
     *
     * @return  self
     */ 
    public function setLastName(string $lastName)
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * Get pattern="/[0-9]{9}/"
     *
     * @return  string|null
     */ 
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * Set pattern="/[0-9]{9}/"
     *
     * @param  string|null  $phone  pattern="/[0-9]{9}/"
     *
     * @return  self
     */ 
    public function setPhone(string $phone)
    {
        $this->phone = $phone;

        return $this;
    }

    /**
     * Get the value of email
     *
     * @return  string|null
     */ 
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param  string|null  $email
     *
     * @return  self
     */ 
    public function setEmail(string $email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get the value of message
     *
     * @return  string|null
     */ 
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set the value of message
     *
     * @param  string|null  $message
     *
     * @return  self
     */ 
    public function setMessage(string $message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get the value of property
     *
     * @return  Property|null
     */ 
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set the value of property
     *
     * @param  Property|null  $property
     *
     * @return  self
     */ 
    public function setProperty(?Property $property):self
    {
        $this->property = $property;

        return $this;
    }

    public function fullName(){
        return  ucfirst($this->getfirstName()).' '.ucfirst($this->getlastName());
    }
}