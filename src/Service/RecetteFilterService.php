<?php
namespace App\Service;


use App\Repository\RecetteRepository;


class RecetteFilterService
{
    public function __construct(private RecetteRepository $recetteRepository)
    {
    }

    public function getRecettes(?string $saison): array
    {
        if ($saison) {
            return $this->recetteRepository->findBySeason($saison);
        }


        return $this->recetteRepository->findLastRecettes();
    }
}
