<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;


class PropertySearch 
{
    /**
     * @var int|null
     */
    private $maxPrice; 

    /**
     * @var int|null
    * @Assert\Range( 
    *  min=10,
    *  max=400,
    *  minMessage="The surface must be greater than or equal to 10.",
    *  maxMessage="The surface must less than or equal to 400.")
    * @Assert\NotBlank(message="This field cannot be blank.")
    * @Assert\NotNull
    */
    private $minSurface;


    /**
     * @var ArrayCollection
    */
    private $options;

    public function __construct()
    {
        $this->options = new ArrayCollection();
    }

    /**
     * @return int
     */
    public function getMaxPrice(): ?int
    {
        return $this->maxPrice;
    }

    /**
     * @param int $int $maxPrice
     */
    public function setMaxPrice(int $maxPrice): self
    {
        $this->maxPrice = $maxPrice;

        return $this;
    }

    /**
     * @return int
     */
    public function getMinSurface(): ?int
    {
        return $this->minSurface;
    }

    /**
     * @param int $minSurface
     */
    public function setMinSurface(int $minSurface): self
    {
        $this->minSurface = $minSurface;
        return $this;
    }

    /**
     * @return ArrayCollection
     */
    public function getOptions():ArrayCollection
    {
        return $this->options;
    }

    /**
     * @param ArrayCollection $options
     */
    public function setOptions(ArrayCollection $options): void
    {
        $this->options = $options;
    }
}
