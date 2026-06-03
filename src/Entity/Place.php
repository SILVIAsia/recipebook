<?php

namespace App\Entity;

use App\Repository\PlaceRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlaceRepository::class)]
class Place
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $namePlace = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePlace(): ?string
    {
        return $this->namePlace;
    }

    public function setNamePlace(string $namePlace): static
    {
        $this->namePlace = $namePlace;

        return $this;
    }
}
