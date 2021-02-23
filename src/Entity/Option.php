<?php

namespace App\Entity;

use App\Repository\OptionRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=OptionRepository::class)
 * @ORM\Table(name="Opt")
 */
class Option
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This field cannot be blank.")
     */
    private $name;

    /**
     * @ORM\ManyToMany(targetEntity=Property::class, mappedBy="options")
     */
    private $properties;
    

    /**
     * @return int
     */
    public function getId(): ?int
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @return Property
     */
    public function getProperties(): ?Property
    {
        return $this->properties;
    }

    /**
     * @param Property $properties
     */
    public function setProperties(?Property $properties): self
    {
        $this->properties = $properties;

        return $this;
    }
}
