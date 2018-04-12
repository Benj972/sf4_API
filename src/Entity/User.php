<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use JMS\Serializer\Annotation as Serializer;
use JMS\Serializer\Annotation\ExclusionPolicy;
use JMS\Serializer\Annotation\Expose;
/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table()
 *
 * @ExclusionPolicy("all")
 *
 */
class User
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
     *
     * @Expose
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Expose
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Expose
     */
    private $lastname;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Expose
     */
    private $firstname;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    public function getId()
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
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
