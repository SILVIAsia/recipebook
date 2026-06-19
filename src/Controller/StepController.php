<?php

namespace App\Controller;

use App\Entity\Step;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/step')]
class StepController extends AbstractController
{



    #[Route('/add/{recetteId}', name: 'step_add', methods: ['GET'])]
    public function add(int $recetteId, EntityManagerInterface $entityManager, RecetteRepository $recetteRepository): Response
    {
        $recette = $recetteRepository->find($recetteId);
        $step = new Step();
        $step->setRecette($recette);
        $entityManager->persist($step);
        $entityManager->flush();
        return $this->redirectToRoute('recette_edit', ['id' => $recetteId]);
    }


    #[Route('/{id}/delete', name: 'step_delete', methods: ['GET'])]
    public function delete(Step $step, EntityManagerInterface $entityManager): Response
    {
        $recetteId = $step->getRecette()->getId();
        $entityManager->remove($step);
        $entityManager->flush();
        $this->addFlash('success', 'Etape supprimée');
        return $this->redirectToRoute('recette_edit', ['id' => $recetteId]);
    }
}
