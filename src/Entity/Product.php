<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
use Hateoas\Configuration\Annotation as Hateoas;
use JMS\Serializer\Annotation\Groups;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 * @ORM\Table()
 *
 * @ExclusionPolicy("all")
 *
 * @Hateoas\Relation(
 *      "self",
 *      href = @Hateoas\Route(
 *          "app_product_show",
 *          parameters = { "id" = "expr(object.getId())" },
 *          absolute = true
 *      )
 * )
 *
 * @Hateoas\Relation(
 *      "list",
 *      href = @Hateoas\Route(
 *          "app_product_list",
 *          absolute = true
 *      )
 * )
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
     * @Serializer\Since("1.0")
     * @Groups({"search_body"})
     */
    private $name;

    /**
     * @ORM\Column(type="datetime")
     * @Expose
     * @Serializer\Since("1.0")
     */
    private $dateCreate;

    /**
     * @ORM\Column(type="text")
     * @Expose
     * @Serializer\Since("1.0")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255)
     * @Expose
     * @Serializer\Since("1.0")
     */
    private $size;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Expose
     * @Serializer\Since("1.0")
     */
    private $multimedia;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Expose
     * @Serializer\Since("1.0")
     */
    private $networks;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Expose
     * @Serializer\Since("1.0")
     */
    private $screen;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Expose
     * @Serializer\Since("1.0")
     */
    private $autonomy;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Manufacturer", inversedBy="products", cascade={"persist"})
     * @Expose
     * @Serializer\Since("1.0")
     */
    private $manufacturer;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Configuration", mappedBy="product", cascade={"persist","remove"}, orphanRemoval=true)
     * @Expose
     * @Serializer\Since("1.0")
     */
    private $configurations;

    public function __construct()
    {
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

    public function getDateCreate(): ?\DateTime
    {
        return $this->dateCreate;
    }

    public function setDateCreate(\DateTime $dateCreate): self
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
        $this->configurations[] = $configuration;
        $configuration->setProduct($this);
    }

    public function removeConfiguration(Configuration $configuration)
    {
        $this->configurations->removeElement($configuration);
        $configuration->setProduct(null);
    }

    public function getConfigurations()
    {
        return $this->configurations;
    }
}
