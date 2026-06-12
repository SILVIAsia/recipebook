<?php

namespace App\Controller;
use App\Entity\Recette;
use App\Entity\Ingredient;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\RecetteRepository;


#[Route('/ingredient')]
class IngredientController extends AbstractController
{

    #[Route('/add/{recetteId}', name: 'ingredient_add', methods: ['GET'])]
    public function add(int $recetteId, EntityManagerInterface $entityManager, RecetteRepository $recetteRepository): Response
    {
        $recette = $recetteRepository->find($recetteId);
        $ingredient = new Ingredient();
        $ingredient->setRecette($recette);
        $entityManager->persist($ingredient);
        $entityManager->flush();
        return $this->redirectToRoute('recette_edit', ['id' => $recetteId]);
    }



    #[Route('/{id}/delete', name: 'ingredient_delete', methods: ['GET'])]
    public function delete(Ingredient $ingredient, EntityManagerInterface $entityManager): Response
    {
        $recetteId = $ingredient->getRecette()->getId();
        $entityManager->remove($ingredient);
        $entityManager->flush();
        $this->addFlash('success', 'Ingrédient supprimé');
        return $this->redirectToRoute('recette_edit', ['id' => $recetteId]);
    }
}
