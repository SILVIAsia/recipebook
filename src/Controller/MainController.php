<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController

{
    #[Route("/home", name: "main_home", methods: ["GET"])]
    public function home(): Response
    {
        return $this->render("main/home.html.twig");
    }


    #[Route("/test", name: "main_test", methods: ["GET"])]
    public function test(): Response
    {
        $serie = [
            "title" => "Shakira",
            "year" => 2026,
        ];

        return $this->render("main/test.html.twig", [
            "serie" => $serie,
            "autreVar" =>123456,
        ]);
    }



}
