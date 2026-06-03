<?php

namespace App\Entity;

use App\Repository\ActivityRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ActivityRepository::class)]
class Activity
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $nameActivity = null;

    #[ORM\Column(length: 255)]
    private ?string $public = null;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameActivity(): ?string
    {
        return $this->nameActivity;
    }

    public function setNameActivity(string $nameActivity): static
    {
        $this->nameActivity = $nameActivity;

        return $this;
    }

    public function getPublic(): ?string
    {
        return $this->public;
    }

    public function setPublic(string $public): static
    {
        $this->public = $public;

        return $this;
    }


}
