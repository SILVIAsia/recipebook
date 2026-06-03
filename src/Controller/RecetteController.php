<?php

namespace App\Controller;

use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/recette')]
final class RecetteController extends AbstractController
{
    #[Route('/', name: 'recette_list')]
    public function list(RecetteRepository $recetteRepository): Response
    {
        // va chercher la liste en bdd
     //   $recettes = $recetteRepository->findBy([], ["titre" => "ASC"]);

        $recettes = $recetteRepository->findLastRecettes();

        return $this->render('recette/list.html.twig', [
            "recettes" => $recettes,
        ]);
    }

    #[Route('/{id}', name: 'recette_detail')]
    public function detail($id, RecetteRepository $recetteRepository): Response
    {
        $recette = $recetteRepository->findOneBy(["published" => true, "id" => $id]);
        //va chercher le detail en bdd

        if (!$recette) {
            throw $this->createNotFoundException("No existe Sory dude");
        }
            return $this->render('recette/detail.html.twig', [
                "recette" => $recette,
        ]);
    }



}


