<?php

namespace App\Entity;

use App\Repository\StatusRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: StatusRepository::class)]
class Status
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 50, nullable: true)]
    private ?string $nameStatus = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameStatus(): ?string
    {
        return $this->nameStatus;
    }

    public function setNameStatus(?string $nameStatus): static
    {
        $this->nameStatus = $nameStatus;

        return $this;
    }
}
