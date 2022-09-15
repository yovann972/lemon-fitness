<?php

namespace App\Entity;

use App\Repository\StructuresRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StructuresRepository::class)]
class Structures
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $address = null;

    #[ORM\Column(length: 255)]
    private ?string $city = null;

    #[ORM\Column(length: 5)]
    private ?string $zipCode = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $clientId = null;

    #[ORM\ManyToOne(inversedBy: 'structures')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Partners $partnerId = null;

    #[ORM\OneToMany(mappedBy: 'installId', targetEntity: Permissions::class, orphanRemoval: true)]
    private Collection $perms;

    public function __construct()
    {
        $this->perms = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAddress(): ?string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getZipCode(): ?string
    {
        return $this->zipCode;
    }

    public function setZipCode(string $zipCode): self
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    public function getClientId(): ?User
    {
        return $this->clientId;
    }

    public function setClientId(User $clientId): self
    {
        $this->clientId = $clientId;

        return $this;
    }

    public function getPartnerId(): ?Partners
    {
        return $this->partnerId;
    }

    public function setPartnerId(?Partners $partnerId): self
    {
        $this->partnerId = $partnerId;

        return $this;
    }

    /**
     * @return Collection<int, Permissions>
     */
    public function getPerms(): Collection
    {
        return $this->perms;
    }

    public function addPerm(Permissions $perm): self
    {
        if (!$this->perms->contains($perm)) {
            $this->perms->add($perm);
            $perm->setInstallId($this);
        }

        return $this;
    }

    public function removePerm(Permissions $perm): self
    {
        if ($this->perms->removeElement($perm)) {
            // set the owning side to null (unless already changed)
            if ($perm->getInstallId() === $this) {
                $perm->setInstallId(null);
            }
        }

        return $this;
    }
    
    public function __toString()
    {
        return $this->getId();
    }
}
