<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table()
 *
 * @ExclusionPolicy("all")
 *
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     *
     * @Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Expose
     */
    private $name;

    /**
     * @ORM\Column(type="datetime_immutable")
     * @Expose
     */
    private $dateCreate;

    /**
     * @ORM\Column(type="text")
     * @Expose
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $size;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $multimedia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $networks;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $screen;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $autonomy;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="product",  cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $images;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Manufacturer", inversedBy="product", cascade={"persist"})
     */
    private $manufacturer;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Configuration", cascade={"persist"})
     */
    private $configurations;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="products", cascade={"persist"})
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    public function __construct()
    {
        $this->images = new ArrayCollection();
        $this->configurations = new ArrayCollection();
        $this->dateCreate = new \Datetime();    
    }

    public function getId()
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getDateCreate(): ?\DateTimeImmutable
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTimeImmutable $dateCreate): self
    {
        $this->dateCreate = $dateCreate;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSize(): ?string
    {
        return $this->size;
    }

    public function setSize(string $size): self
    {
        $this->size = $size;

        return $this;
    }

    public function getMultimedia(): ?string
    {
        return $this->multimedia;
    }

    public function setMultimedia(?string $multimedia): self
    {
        $this->multimedia = $multimedia;

        return $this;
    }

    public function getNetworks(): ?string
    {
        return $this->networks;
    }

    public function setNetworks(?string $networks): self
    {
        $this->networks = $networks;

        return $this;
    }

    public function getScreen(): ?string
    {
        return $this->screen;
    }

    public function setScreen(?string $screen): self
    {
        $this->screen = $screen;

        return $this;
    }

    public function getAutonomy(): ?string
    {
        return $this->autonomy;
    }

    public function setAutonomy(?string $autonomy): self
    {
        $this->autonomy = $autonomy;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    public function addImage(Image $image)
    {
        $this->images[] = $image;
        // We link the image to the product
        $image->setProduct($this);
    }

    public function removeImage(Image $image)
    {
        $this->images->removeElement($image);
        $image->setProduct(null);
    }
    
    public function getImages()
    {
        return $this->images;
    }

    public function getManufacturer()
    {
        return $this->manufacturer;
    }

    public function setManufacturer(Manufacturer $manufacturer)
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function addConfiguration(Configuration $configuration)
    {
        $configuration->addproduct($this); // synchronously updating inverse side
        $this->configurations[] = $configuration;
    }

    public function removeConfiguration(Configuration $configuraton)
    {
        // Ici on utilise une méthode de l'ArrayCollection, pour supprimer la configuration en argument
        $this->configurations->removeElement($configuration);
    }

    public function getConfigurations()
    {
        return $this->configurations;
    }
   
    public function getClient()
    {
        return $this->client;
    }

    public function setClient(Client $client)
    {
        $this->client = $client;

        return $this;
    }
}
