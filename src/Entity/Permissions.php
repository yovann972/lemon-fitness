<?php

namespace App\Entity;

use App\Repository\PermissionsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PermissionsRepository::class)]
class Permissions
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(nullable: true)]
    private ?bool $sellDrinks = null;

    #[ORM\Column(nullable: true)]
    private ?bool $membersStatistiques = null;

    #[ORM\Column(nullable: true)]
    private ?bool $paymentSchedules = null;

    #[ORM\Column(nullable: true)]
    private ?bool $employeePlanning = null;

    #[ORM\ManyToOne(inversedBy: 'perms')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Structures $installId = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function isSellDrinks(): ?bool
    {
        return $this->sellDrinks;
    }

    public function setSellDrinks(bool $sellDrinks): self
    {
        $this->sellDrinks = $sellDrinks;

        return $this;
    }

    public function isMembersStatistiques(): ?bool
    {
        return $this->membersStatistiques;
    }

    public function setMembersStatistiques(bool $membersStatistiques): self
    {
        $this->membersStatistiques = $membersStatistiques;

        return $this;
    }

    public function isPaymentSchedules(): ?bool
    {
        return $this->paymentSchedules;
    }

    public function setPaymentSchedules(bool $paymentSchedules): self
    {
        $this->paymentSchedules = $paymentSchedules;

        return $this;
    }

    public function isEmployeePlanning(): ?bool
    {
        return $this->employeePlanning;
    }

    public function setEmployeePlanning(bool $employeePlanning): self
    {
        $this->employeePlanning = $employeePlanning;

        return $this;
    }

    public function getInstallId(): ?Structures
    {
        return $this->installId;
    }

    public function setInstallId(?Structures $installId): self
    {
        $this->installId = $installId;

        return $this;
    }
}
