<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Cocur\Slugify;
use Cocur\Slugify\Slugify as SlugifySlugify;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass=PropertyRepository::class)
 * @ORM\Table(name="Properties")
 */
class Property
{
    const HEAT = [
        0 => 'Electric',
        1 => 'Gas',
        2 => 'Hybrid'
    ];

    public function __construct()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This field cannot be blank.")
     * @Assert\NotNull
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Assert\NotBlank(message="This description cannot be blank.")
     * @Assert\NotNull
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *  min=10,
     *  max=400,
    *   minMessage="The surface must be greater than or equal to 10.",
    *   maxMessage="The surface must less than or equal to 400.")
     * @Assert\NotBlank(message="This field cannot be blank.")
     * @Assert\NotNull
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *  min=1,
     *  max=5,
    *   minMessage="The number rooms must be greater than or equal to 1.",
    *   maxMessage="The number rooms must less than or equal to 6.")
     * @Assert\NotBlank(message="This field cannot be blank.")
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *  min=2,
     *  max=10,
    *   minMessage="The number of bedrooms must be greater than or equal to 1.",
    *   maxMessage="The number of bedrooms must less than or equal to 10.")
     * @Assert\NotBlank(message="This field cannot be blank.")
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *  min=0,
     *  max=15,
    *   minMessage="The floor must be greater than or equal to 1.",
    *   maxMessage="The floor must less than or equal to 10.")
     * @Assert\NotBlank(message="This field cannot be blank.")
     */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     * @Assert\Range(
     *  min=1000,
     *  max=10000,
    *   minMessage="The price must be greater than or equal to 1000.",
    *   maxMessage="The price must less than or equal to 10 000.")
     * @Assert\NotBlank(message="This field cannot be blank.")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     * @Assert\NotBlank(message="This field cannot be blank.")
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This field cannot be blank.")
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This field cannot be blank.")
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank(message="This field cannot be blank.")
     * @Assert\Regex("/^[0-9]{5}$/")
     */
    private $postalCode;

    /**
     * @ORM\Column(type="boolean",options={"default":false})
     */
    private $sold = false;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $updatedAt;

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
    public function getTitle(): ?string
    {
        return $this->title;
    }
    
    /**
     * @return string
     */
    public function getSlug():string
    {
        return (new SlugifySlugify())->slugify($this->title);
    }

     /**
     * @param string $title
     */
    public function setTitle(?string $title): self
    {
        $this->title = $title;

        return $this;
    }

    /**
     * @return string
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return int
     */
    public function getSurface(): ?int
    {
        return $this->surface;
    }

    /**
     * @param $surface
     */
    public function setSurface(?int $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    /**
     * @return int
    */
    public function getRooms(): ?int
    {
        return $this->rooms;
    }

     /**
     * @param int $rooms
     */
    public function setRooms(?int $rooms): self
    {
        $this->rooms = $rooms;

        return $this;
    }

    /**
     * @return int
     */
    public function getBedrooms(): ?int
    {
        return $this->bedrooms;
    }

     /**
     * @param int $bedrooms
     */
    public function setBedrooms(?int $bedrooms): self
    {
        $this->bedrooms = $bedrooms;

        return $this;
    }

    /**
     * @return int
     */
    public function getFloor(): ?int
    {
        return $this->floor;
    }

    /**
     * @param int $floor
     */
    public function setFloor(?int $floor): self
    {
        $this->floor = $floor;

        return $this;
    }

     /**
     * @return int
     */
    public function getPrice(): ?int
    {
        return $this->price;
    }

    /**
     * @return strinf
     */
    public function getFormatedPrice()
    {
        return number_format($this->price,0,'',' '); 
    }

    /**
     * @param int $price
     */
    public function setPrice(?int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return int
     */
    public function getHeat(): ?int
    {
        return $this->heat;
    }

    /**
     * @return string
     */
    public function getHeatType(): ?string
    {
        return self::HEAT[$this->heat];
    }

    /**
     * @param int $heat
     */
    public function setHeat(int $heat): self
    {
        $this->heat = $heat;

        return $this;
    }

     /**
     * @return string
     */
    public function getCity(): ?string
    {
        return $this->city;
    }


    /**
     * @param string $city
     */
    public function setCity(?string $city): self
    {
        $this->city = $city;

        return $this;
    }

    /**
     * @return string
     */
    public function getAdress(): ?string
    {
        return $this->adress;
    }

    /**
     * @param string $adress
     */
    public function setAdress(?string $adress): self
    {
        $this->adress = $adress;

        return $this;
    }

    /**
     * @return string
     */
    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    /**
     * @param string $postalCode
     */
    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    /**
     * @return bool
     */
    public function getSold(): ?bool
    {
        return $this->sold;
    }

    /**
     * @param bool $sold
     */
    public function setSold(?bool $sold): self
    {
        $this->sold = $sold;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     */
    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * @return DateTimeInterface
     */
    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updatedAt;
    }

    /**
     * @param \DateTimeInterface $createdAt
     */
    public function setUpdatedAt(?\DateTimeInterface $updatedAt): self
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
