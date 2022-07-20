<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\AjouterUserType;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;




class UserController extends AbstractController
{
    #[Route('/liste_user', name: 'app_user')]
    public function index( UserRepository $userRepository): Response
    { //controler doit envoyer la liste utilisateur  a la  vue
        return $this->render('user/user.html.twig', [
            "liste_users" => $userRepository->findAll()
            
        
        ]);
    }
// methode pour allerchercher un seul utilisateur
    //code pour l'annotation pour passer un paramètre dans lurl
    #[Route("/profil-user/{id}", name: "app_detail_user")]
    public function getOneuser( $id,UserRepository $userRepository): Response
    { 
        return $this->render('user/show_user.html.twig', [
            "user" => $userRepository->find($id)
           
            
        
        ]);
    }



    // methode pour ajouter un user
    //code pour l'annotation pour passer un paramètre dans lurl
    #[Route("/ajouter-user", name: "app_add_user")]
    public function adduser(Request $request,UserRepository $userRepository,): Response
    { 
        //creer un objet de la classe user
        $user = new User();
        //je creer un formulaire et je le lie a nôtre objet  user on met :: pour prendre que le nom de la classe
        $form = $this->createForm(AjouterUserType::class,$user);
        //je met mon form a l'écoute des requette qui passe dans l'url
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $userRepository->add($user);
            return $this->redirectToRoute('app_user');

        }

        return $this->render('user/add_user.html.twig', 
        [
        
        "form" =>$form->createView()    
        
        ]
      );
    }





    // methode pour aller chercher un seul id
    #[Route("/delete-user/{id}", name: "app_delete_user")]
    public function deleteeuser( $id,UserRepository $userRepository): Response

    {// je récupère le user par son id avec la méthode find de UserRepo
         $user= $userRepository->find($id);
//je supprime le user avec la méthode remove  de userRepo
        $userRepository->remove($user);
        //je redirige vers la page user
        return $this->redirectToRoute('app_user');
        
    }

    
    #[Route("/modifier-user/{id}", name: "app_edit_user")]
    public function edituser($id , Request $request,UserRepository $userRepository,): Response
    { 
        $user = $userRepository->find($id);
        
        $form = $this->createForm(AjouterUserType::class,$user);
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){

            $userRepository->add($user);
            return $this->redirectToRoute('app_user');

        }

        return $this->render('user/edit_user.html.twig', 
        [
        
        "form" =>$form->createView()    
        
        ]
      );
    }



    


}
