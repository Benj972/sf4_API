<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ManufacturerRepository")
 */
class Manufacturer
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

     /**
    * @ORM\OneToMany(targetEntity="App\Entity\Product", mappedBy="manufacturer")
    */
    private $products;

    public function __construct()
    {
        $this->products = new ArrayCollection();
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

    public function addProduct(Product $product)
    {
        $this->products[] = $product;
        // We link the product to the manufacturer
        $product->setManufacturer($this);
    }

    public function removeProduct(Product $product)
    {
        $this->products->removeElement($product);
    }
    
    public function getProducts()
    {
        return $this->products;
    }
}
