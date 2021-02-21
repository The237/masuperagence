<?php

namespace App\Entity;

use App\Repository\PropertyRepository;
use Doctrine\ORM\Mapping as ORM;
use Cocur\Cocur\Slugify;
use Cocur\Slugify\Slugify as SlugifySlugify;

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
     */
    private $title;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="integer")
     */
    private $surface;

    /**
     * @ORM\Column(type="integer")
     */
    private $rooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $bedrooms;

    /**
     * @ORM\Column(type="integer")
     */
    private $floor;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\Column(type="integer")
     */
    private $heat;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $city;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $adress;

    /**
     * @ORM\Column(type="string", length=255)
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
    public function setTitle(string $title): self
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
    public function setSurface(int $surface): self
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
    public function setRooms(int $rooms): self
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
    public function setBedrooms(int $bedrooms): self
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
    public function setFloor(int $floor): self
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
    public function setPrice(int $price): self
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
    public function setCity(string $city): self
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
    public function setAdress(string $adress): self
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
    public function setPostalCode(string $postalCode): self
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
    public function setSold(bool $sold): self
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
