<?php

namespace App\Entity;
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
}
