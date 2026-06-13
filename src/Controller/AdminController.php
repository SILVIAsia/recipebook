<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/admin')]
final class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'admin_dashboard')]
    public function dashboard(): Response  // ← sin UserRepository
    {
        return $this->render('admin/dashboard.html.twig');
    }

    #[Route('/animateurs', name: 'admin_animateurs', methods: ['GET'])]
    public function animateurs(UserRepository $userRepository): Response
    {
        $animateurs = $userRepository->findAllOrdered();
        return $this->render('admin/animateurs.html.twig', [
            'animateurs' => $animateurs,
        ]);
    }

    #[Route('/animateur/{id}', name: 'admin_animateur_detail', methods: ['GET'])]
    public function animateurDetail(User $user): Response
    {
        return $this->render('admin/animateur_detail.html.twig', [
            'user' => $user,
        ]);
    }

    #[Route('/animateur/{id}/modifier', name: 'admin_animateur_edit', methods: ['GET', 'POST'])]
    public function animateurEdit(User $user, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Animateur modifié avec succès');
            return $this->redirectToRoute('admin_animateurs');
        }

        return $this->render('admin/animateur_edit.html.twig', [
            'form' => $form,
            'user' => $user,
        ]);
    }
}
