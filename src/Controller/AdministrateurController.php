<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdministrateurController extends AbstractController
{
    /**
     * @Route("/admin", name="admin_home")
     */
    public function index(): Response
    {
        return $this->render('administrateur/index.html.twig', [
            'controller_name' => 'AdministrateurController',
        ]);
    }
    /**
     * @Route("/admin/listeadmin", name="app_administrateur_liste")
     */
    public function liste(): Response
    {
     
        $repository = $this->getDoctrine()->getRepository( Utilisateur::class);
        $Admin1 = $repository->findAll();
        $Admins= array();
        foreach( $Admin1 as $admin)
        {
            if($admin->getRoles()==["ADMIN_ROLE"])
            array_push(Admins,admin);
        }
       
        return $this->render('administrateur/liste.html.twig', [
            'controller_name' => 'AdminController',
            "Admins" => $Admins,
        ]);
    
    }
    /**
     * @Route("/admin/nouveladmin", name="newteacher")
     */
    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            
            );
            user.setRoles(["ROLE_ADMIN"]);
             $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('administrateur/new.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
    /**
     * @Route("/admin/listeenseignants", name="adminListeEnseignant")
     */
    public function teachers(): Response
    
    {
        $repository = $this->getDoctrine()->getRepository( Utilisateur::class);
        $Admin = $repository->findUsersByRole(["ROLE_ENSEIGNANT"]);
       
        return $this->render('enseignants/index.html.twig', [
            'controller_name' => 'AdminController',
            "Enseignants" => $Admin,
        ]);
    }
       /**
     * @Route("/admin/nouvelenseignant", name="new_teacher")
     */
    public function newteacher(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new Utilisateur();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            
            );
            user.setRoles(["ROLE_ENSEIGNANT"]);
             $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('enseignants/new.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }
}
