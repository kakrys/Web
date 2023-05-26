<?php

namespace App\Entity;

use App\Repository\AdminRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AdminRepository::class)]
#[ORM\Table(name: '`admin`')]
class Admin
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $adm = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAdm(): ?string
    {
        return $this->adm;
    }

    public function setAdm(string $adm): self
    {
        $this->adm = $adm;

        return $this;
    }
}
