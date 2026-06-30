<?php

namespace App\Controller;



use App\Form\UserType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;



#[Route('/mon-espace')]
#[IsGranted('ROLE_USER')]
class UserController extends AbstractController
{
    #[Route('', name: 'mon_espace', methods: ['GET'])]
    public function index(RecetteRepository $recetteRepository): Response
    {
        $recettes = $recetteRepository->findBy(
            ['user' => $this->getUser()],
            ['dateCreated' => 'DESC']
        );


        return $this->render('user/mon_espace.html.twig', [
            'recettes' => $recettes,
        ]);
    }


    #[Route('/profil', name: 'mon_espace_profil', methods: ['GET', 'POST'])]
    public function profil(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            $this->addFlash('success', 'Profil modifié avec succès');
            return $this->redirectToRoute('mon_espace');
        }


        return $this->render('user/profil.html.twig', [
            'form' => $form,
        ]);
    }
}

