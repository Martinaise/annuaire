<?php

namespace App\Controller;

use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TwigController extends AbstractController
{
    #[Route('/twig', name: 'app_twig')]
    public function index(): Response
    {$var = "je suis la variable";
        $a = 12;
        $b = 5;
        $c =$a *$b;
        //les tableaux
        $table =[ 1,9,6,78,2];
        $dateDuJour =  new DateTime();

        return $this->render('twig/twig.html.twig',
         [
            "text" => $var,
            "result" => $c,
            "test" => [],
            "tableau" => $table,
            "date_du_jour" => $dateDuJour
                   
        ]);
    }



    #[Route('/twig-tableau', name: 'app_twig_tableau')]
    public function twigTableau(): Response
    
    {
        $tab = ["banane" , "pomme" , "poire" , "mangue"];

        $users = [
        ["name"=>"bill" , "prenom"=>"gate" ],
        ["name"=>"steve" , "prenom"=>"jobs" ],
        ["name"=>"jean" , "prenom"=>"castex" ]

        ];
    
    
        return $this->render('twig/twig_tableau.html.twig',
         [
             "fruits" => $tab,
             "users" => $users
           
        ]);
    }
}
