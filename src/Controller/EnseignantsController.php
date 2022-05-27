<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class EnseignantsController extends AbstractController
{
    /**
     * @Route("/enseignants", name="app_Enseignant")
     */
    public function index(): Response
    
    {
      
        return $this->render('enseignants/index.html.twig', [
            'controller_name' => 'PageEnseignant',
        ]);
    }
  
}
