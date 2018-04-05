<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FeatureRepository")
 */
class Feature
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text")
     */
    private $general;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $multimedia;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $memory;

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

    public function getId()
    {
        return $this->id;
    }

    public function getGeneral(): ?string
    {
        return $this->general;
    }

    public function setGeneral(string $general): self
    {
        $this->general = $general;

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

    public function getMemory(): ?string
    {
        return $this->memory;
    }

    public function setMemory(?string $memory): self
    {
        $this->memory = $memory;

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
}
