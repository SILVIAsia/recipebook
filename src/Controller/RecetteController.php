<?php

namespace App\Controller;

use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\RecetteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\Request;

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


    #[Route('/creer', name: 'recette_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        //cree une instance de recette
        $recette = new Recette();
        //cree le formulaire
        $recetteForm = $this->createForm(RecetteType::class, $recette);
        //traite le formulaire
        $recetteForm->handleRequest($request);
        // si le form est soumis
        if ($recetteForm->isSubmitted() && $recetteForm->isValid()) {
            // on garde dans bdd pour faire un insert on utilise el em o el repository
            // debo pedirle a synfony el $em de me le passer mas arriba
            $entityManager->persist($recette);
            $entityManager->flush();

            //crée un message qui v  si afficcher une seule fois sur la prochaine page
            $this->addFlash('success',"Bravo ta recette a été crée!!");

            //redirige versla page de details de recette
            return $this->redirectToRoute('recette_detail', ['id' => $recette->getId()]);

        }

        return $this->render('recette/create.html.twig', [
            //passe le formulaire a twig
            "recetteForm" => $recetteForm,
        ]);
    }




    #[Route('/{id}/modifier', name: 'recette_edit', methods: ['GET', 'POST'])]
    public function edit(Recette $recette, Request $request, EntityManagerInterface $entityManager): Response
    {

        //cree le formulaire
        $recetteForm = $this->createForm(RecetteType::class, $recette);
        //traite le formulaire
        $recetteForm->handleRequest($request);
        // si le form est soumis
        if ($recetteForm->isSubmitted() && $recetteForm->isValid()) {
            // on garde dans bdd pour faire un insert on utilise el em o el repository
            // debo pedirle a synfony el $em de me le passer mas arriba
            $entityManager->persist($recette);
            $entityManager->flush();

            //crée un message qui v  si afficcher une seule fois sur la prochaine page
            $this->addFlash('success',"Bravo votre recette a été modifié!!");

            //redirige versla page de details de recette
            return $this->redirectToRoute('recette_detail', ['id' => $recette->getId()]);

        }

        return $this->render('recette/edit.html.twig', [
            "recette" => $recette,
            //passe le formulaire a twig
            "recetteForm" => $recetteForm,
        ]);
    }


   #[Route('/{id}/delete/{token}', name: 'recette_delete', requirements:["id" => "\d+"], methods: ['GET','POST',])]
   public function delete(Recette $recette, EntityManagerInterface $entityManager, $token): Response
   {

      if ($this->isCsrfTokenValid(
          'delete'. $recette->getId(), $token))
     {

           $entityManager->remove($recette);
           $entityManager->flush();

           $this->addFlash('success', "La recette a été supprimé!!");
           return $this->redirectToRoute('recette_list');
       }
       $this ->addFlash("danger", "Vous pouvez pas eliminer la rectte");
       return $this->redirectToRoute('recette_detail', ['id' => $recette->getId()]);
   }

    // c'est ma list  de toutes les  recettes
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


