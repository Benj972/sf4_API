<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ConfigurationRepository")
 * @ExclusionPolicy("all")
 */
class Configuration
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     * @Expose
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Expose
     */
    private $color;

    /**
     * @ORM\Column(type="text", nullable=true)
     * @Expose
     */
    private $memory;

    /**
     * @ORM\Column(type="string", length=255)
     * @Expose
     */
    private $serial;

    /**
     * @ORM\Column(type="decimal", precision=6, scale=2)
     * @Expose
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Image", mappedBy="configuration",  cascade={"persist", "remove"}, orphanRemoval=true)
     */
    private $images;

     /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Product", inversedBy="configurations", cascade={"persist"})
     * @ORM\JoinColumn(name="product_id", referencedColumnName="id")
     */
    private $product;

    public function getId()
    {
        return $this->id;
    }

    public function getColor(): ?string
    {
        return $this->color;
    }

    public function setColor(string $color): self
    {
        $this->color = $color;

        return $this;
    }

    public function getMemory(): ?string
    {
        return $this->memory;
    }

    public function setMemory(?string $memory): self
    {
        $this->memory = $memory;

        return $this;
    } 

     public function getSerial(): ?string
    {
        return $this->serial;
    }

    public function setSerial(string $serial): self
    {
        $this->serial = $serial;

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

    public function getProduct()
    {
        return $this->product;
    }

    public function setProduct(Product $product)
    {
        $this->product = $product;

        return $this;
    }
}
