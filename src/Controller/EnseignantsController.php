<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Entity\Eleve;
use App\Entity\Cappfpmp;
use App\Form\SousligneType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;


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
     /**
     * @Route("/enseignants/listeeleves", name="elevesliste")
     */
    public function liste(): Response
    
    {
      
        return $this->render('enseignants/liste.html.twig', [
            'controller_name' => 'PageEnseignant',
        ]);
    }
      /**
     * @Route("/enseignants/noterelevecap/{id}", name="notereleve")
     */
    public function noter(ELeve $eleve): Response
    
    {
      $pfpmp1=$eleve->getCappfpmps()[0];
      $pfpmp2=$eleve->getCappfpmps()[1];
      $pfpmp3=$eleve->getCappfpmps()[2];
      $pfpmp4=$eleve->getCappfpmps()[3];
        return $this->render('enseignants/choixpfmpnotecap.html.twig', [
            'controller_name' => 'PageEnseignant',
            'pfpmp1' => $pfpmp1,
            'pfpmp2' => $pfpmp2,
            'pfpmp3' => $pfpmp3,
            'pfpmp4' => $pfpmp4
            
        ]);
    }
   /**
     * @Route("/enseignant/{id}/noterpfpmp", name="noterpfmp")
     */
    public function evaluercap(Cappfpmp $pfmp, Request $request,EntityManagerInterface $entityManager): Response
    
    {dump($request);
        if($request->request->count()>0)
        {foreach($pfmp->getLignes() as $Lignes )
            {foreach($Lignes->getSousligne() as $sousligne)
                {
                    $sousligne->setNote($request->request->get($sousligne->getTravail()->getLibelle()));
                    $entityManager->persist($sousligne);
            $entityManager->flush();
                }
             }
            
        }
        

        return $this->render('enseignants/evalcappfmp.html.twig', [
            'PFMP'  =>$pfmp]);

    }
}
