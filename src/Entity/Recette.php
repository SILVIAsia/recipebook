<?php

namespace App\Entity;

use App\Repository\RecetteRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


#[UniqueEntity('titre',message: 'Cette recette existe dejà')]
#[ORM\Entity(repositoryClass: RecetteRepository::class)]
class Recette
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(message: "Ne peut pas être vide")]
    #[Assert\Length(min: 2, max: 180, minMessage: "Le titre de la recette doit avoir au moins 3 caractères! ")]
    #[ORM\Column(length: 180)]
    private ?string $titre = null;

    #[Assert\NotBlank(message: "Ne peut pas être vide")]
    #[ORM\Column(length: 255)]
    private ?string $description = null;


    #[Assert\GreaterThan("0")]
    #[ORM\Column]
    private ?int $cooktime = null;

    #[ORM\Column(nullable: true)]
    private ?int $servings = null;

    #[Assert\NotNull(message:'La date est obligatoire')]
    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $date = null;

//    #[ORM\Column(nullable: true, options: ['default' =>false])]
  //  private ?bool $published = null;


    #[ORM\Column(length: 255, nullable: true)]
    private ?string $picture = null;

    #[ORM\Column(length: 255)]
    private ?string $difficulty = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE)]
    private ?\DateTimeImmutable $dateCreated = null;

    #[ORM\Column(type: Types::DATE_IMMUTABLE, nullable: true)]
    private ?\DateTimeImmutable $dateModified = null;

    #[Assert\GreaterThan("0")]
    #[ORM\Column]
    private ?int $preparationTime = null;

    #[ORM\Column(length: 255)]
    private ?string $producer = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?Category $category = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?Status $status = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?Season $season = null;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?Activity $activity = null;


    #[ORM\Column(length: 50, nullable: true)]
    private ?string $public = null;

    /**
     * @var Collection<int, Ingredient>
     */
  //  #[ORM\OneToMany(targetEntity: Ingredient::class, mappedBy: 'recette', orphanRemoval: true)]
    //private Collection $ingredients;
    #[ORM\OneToMany(targetEntity: Ingredient::class, mappedBy: 'recette', cascade: ['persist'], orphanRemoval: true)]
    private Collection $ingredients;
    /**
     * @var Collection<int, Step>
     */
  //  #[ORM\OneToMany(targetEntity: Step::class, mappedBy: 'recette', orphanRemoval: true)]
    //private Collection $steps;
    #[ORM\OneToMany(targetEntity: Step::class, mappedBy: 'recette', cascade: ['persist'], orphanRemoval: true)]
    private Collection $steps;

    #[ORM\ManyToOne(inversedBy: 'recettes')]
    private ?Place $place = null;


    public function __construct()
    {

        $this->setDateCreated(new \DateTimeImmutable());
        $this->setDateModified(new \DateTimeImmutable());
  //      $this->published = false;
        $this->ingredients = new ArrayCollection();
        $this->steps = new ArrayCollection();
    }


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): static
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): static
    {
        $this->description = $description;

        return $this;
    }



    public function getCooktime(): ?int
    {
        return $this->cooktime;
    }

    public function setCooktime(int $cooktime): static
    {
        $this->cooktime = $cooktime;

        return $this;
    }

    public function getServings(): ?int
    {
        return $this->servings;
    }

    public function setServings(?int $servings): static
    {
        $this->servings = $servings;

        return $this;
    }

    public function getDate(): ?\DateTimeImmutable
    {
        return $this->date;
    }

    public function setDate(\DateTimeImmutable $date): static
    {
        $this->date = $date;

        return $this;
    }



    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): static
    {
        $this->picture = $picture;

        return $this;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(?string $difficulty): static
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getDateCreated(): ?\DateTimeImmutable
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeImmutable $dateCreated): static
    {
        $this->dateCreated = $dateCreated;

        return $this;
    }

    public function getDateModified(): ?\DateTimeImmutable
    {
        return $this->dateModified;
    }

    public function setDateModified(?\DateTimeImmutable $dateModified): static
    {
        $this->dateModified = $dateModified;

        return $this;
    }

    public function getPreparationTime(): ?int
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(int $preparationTime): static
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getProducer(): ?string
    {
        return $this->producer;
    }

    public function setProducer(string $producer): static
    {
        $this->producer = $producer;

        return $this;
    }

    public function getCategory(): ?Category
    {
        return $this->category;
    }

    public function setCategory(?Category $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getStatus(): ?Status
    {
        return $this->status;
    }

    public function setStatus(?Status $status): static
    {
        $this->status = $status;

        return $this;
    }

    public function getSeason(): ?Season
    {
        return $this->season;
    }

    public function setSeason(?Season $season): static
    {
        $this->season = $season;

        return $this;
    }

    public function getActivity(): ?Activity
    {
        return $this->activity;
    }

    public function setActivity(?Activity $activity): static
    {
        $this->activity = $activity;

        return $this;
    }

    public function getPublic(): ?string
    {
        return $this->public;
    }

    public function setPublic(?string $public): static
    {
        $this->public = $public;
        return $this;
    }

    /**
     * @return Collection<int, Ingredient>
     */
    public function getIngredients(): Collection
    {
        return $this->ingredients;
    }

    public function addIngredient(Ingredient $ingredient): static
    {
        if (!$this->ingredients->contains($ingredient)) {
            $this->ingredients->add($ingredient);
            $ingredient->setRecette($this);
        }

        return $this;
    }

    public function removeIngredient(Ingredient $ingredient): static
    {
        if ($this->ingredients->removeElement($ingredient)) {
            // set the owning side to null (unless already changed)
            if ($ingredient->getRecette() === $this) {
                $ingredient->setRecette(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Step>
     */
    public function getSteps(): Collection
    {
        return $this->steps;
    }

    public function addStep(Step $step): static
    {
        if (!$this->steps->contains($step)) {
            $this->steps->add($step);
            $step->setRecette($this);
        }

        return $this;
    }

    public function removeStep(Step $step): static
    {
        if ($this->steps->removeElement($step)) {
            // set the owning side to null (unless already changed)
            if ($step->getRecette() === $this) {
                $step->setRecette(null);
            }
        }

        return $this;
    }

    public function getPlace(): ?Place
    {
        return $this->place;
    }

    public function setPlace(?Place $place): static
    {
        $this->place = $place;

        return $this;
    }
}
