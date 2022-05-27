<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;    
use Symfony\Contracts\Translation\TranslatorInterface;

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
        $Admins = $repository->findBy(['type'=>'Admin']);
       return $this->render('administrateur/liste.html.twig', [
            'controller_name' => 'AdminController',
            "Admins" => $Admins,
            'type' => 'Administrateur'
        ]);
    
    }
    /**
     * @Route("/admin/nouveladmin", name="newteacher")
     */
    public function new(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    { $user = new Utilisateur();
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
            $user->setRoles(["ROLE_ADMIN"]);
            $user->setType("Admin");
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'type' => 'Administrateur'
        ]);
    }
    /**
     * @Route("/admin/listeenseignants", name="adminListeEnseignant")
     */
    public function teachers(): Response
    
    {
        $repository = $this->getDoctrine()->getRepository( Utilisateur::class);
        $Admins = $repository->findBy(['type'=>'Enseignant']);
       
        return $this->render('administrateur/liste.html.twig', [
            'controller_name' => 'AdminController',
            "Admins" => $Admins,
            'type' => 'Enseignant'
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
            $user->setRoles(["ROLE_ENSEIGNANT"]);
            $user->setType("Enseignant");
             $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('enseignants/new.html.twig', [
            'registrationForm' => $form->createView(),
            'type' => 'Enseignant'
        ]);
    }
}
