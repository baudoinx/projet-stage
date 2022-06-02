<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Form\RegistrationFormType;
use App\Form\ChangementmdpType;
use App\Form\AffecterenseigantType;
use App\Form\EleveType;
use App\Entity\Eleve;
use App\Entity\Ligne;
use App\Entity\Sousligne;
use App\Entity\Cappfpmp;
use App\Entity\Travail;
use App\Entity\Competence;
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
    /**
     * @Route("/admin/compte", name="admincompte")
     */
    public function compte(): Response
    
    {
        return $this->render('administrateur/moncompte.html.twig', []);

    }
    /**
     * @Route("/admin/{id}/changermdp", name="adminmdp")
     */
    public function changementmdp(Utilisateur $user, Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    
    {
        $form = $this->createForm(ChangementmdpType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
            $user->setPassword(
            $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            
            );
             $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('registration/changementmdp.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
        return $this->render('administrateur/moncompte.html.twig', []);

    }
      /**
     * @Route("/admin/listeeleves", name="listeeleves")
     */
    public function students(): Response
    
    {
        $repository = $this->getDoctrine()->getRepository( Eleve::class);
        $Eleves = $repository->findAll();
       
        return $this->render('administrateur/listeeleves.html.twig', [
            "Eleves" => $Eleves,
        ]);
    }
   
    /**
     * @Route("/admin/neweleveCAP", name="newstudentcap")
     */
    public function newstudent(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    
    { $eleve=new ELeve();
        $pfmp1=new CAppfpmp();$pfmp1->setNumero(1);
        $pfmp2=new CAppfpmp();$pfmp2->setNumero(2);
        $pfmp3=new CAppfpmp();$pfmp3->setNumero(3);
        $pfmp4=new CAppfpmp();$pfmp4->setNumero(4);
        $ligne11=new  ligne();
        $ligne12=new  ligne();
        $ligne13=new  ligne();
        $ligne14=new  ligne();
        $ligne21=new  ligne();
        $ligne22=new  ligne();
        $ligne23=new  ligne();
        $ligne24=new  ligne();
        $ligne31=new  ligne();
        $ligne32=new  ligne();
        $ligne33=new  ligne();
        $ligne34=new  ligne();
        $ligne41=new  ligne();
        $ligne42=new  ligne();
        $ligne43=new  ligne();
        $ligne44=new  ligne();
        $repository = $this->getDoctrine()->getRepository( Competence::class);
        $competence=$repository->findBy(['id'=>'1']);
        $ligne11->setCompetence($repository->findBy(['id'=>'1'])[0]);
        $ligne12->setCompetence($repository->findBy(['id'=>'2'])[0]);
        $ligne13->setCompetence($repository->findBy(['id'=>'3'])[0]);
        $ligne14->setCompetence($repository->findBy(['id'=>'4'])[0]);
        $ligne21->setCompetence($repository->findBy(['id'=>'1'])[0]);
        $ligne22->setCompetence($repository->findBy(['id'=>'2'])[0]);
        $ligne23->setCompetence($repository->findBy(['id'=>'3'])[0]);
        $ligne24->setCompetence($repository->findBy(['id'=>'4'])[0]);
        $ligne31->setCompetence($repository->findBy(['id'=>'1'])[0]);
        $ligne32->setCompetence($repository->findBy(['id'=>'2'])[0]);
        $ligne33->setCompetence($repository->findBy(['id'=>'3'])[0]);
        $ligne34->setCompetence($repository->findBy(['id'=>'4'])[0]);
        $ligne41->setCompetence($repository->findBy(['id'=>'1'])[0]);
        $ligne42->setCompetence($repository->findBy(['id'=>'2'])[0]);
        $ligne43->setCompetence($repository->findBy(['id'=>'3'])[0]);
        $ligne44->setCompetence($repository->findBy(['id'=>'4'])[0]);

        $sousligne11=new  Sousligne();
        $sousligne12=new  Sousligne();
        $sousligne13=new  Sousligne();
        $sousligne14=new  Sousligne();
        $sousligne15=new  Sousligne();
        $sousligne16=new  Sousligne();
        $sousligne17=new  Sousligne();
        $sousligne18=new  Sousligne();
        $sousligne19=new  Sousligne();
        $sousligne110=new  Sousligne();
        $sousligne111=new  Sousligne();
        $sousligne112=new  Sousligne();
        $sousligne113=new  Sousligne();
        $sousligne114=new  Sousligne();
        $sousligne115=new  Sousligne();
        $sousligne116=new  Sousligne();
        $sousligne117=new  Sousligne();
        $sousligne118=new  Sousligne();
        $sousligne119=new  Sousligne();
        $sousligne120=new  Sousligne();
        $sousligne121=new  Sousligne();
        $sousligne122=new  Sousligne();
        $sousligne123=new  Sousligne();
        $sousligne124=new  Sousligne();
        $sousligne125=new  Sousligne();
        $sousligne126=new  Sousligne();
        $sousligne127=new  Sousligne();
        $repository = $this->getDoctrine()->getRepository( Travail::class);
        $sousligne11->setTravail($repository->findBy(['id'=>'1'])[0]);$ligne11->addSousligne($sousligne11);
        $sousligne12->setTravail($repository->findBy(['id'=>'2'])[0]);$ligne11->addSousligne($sousligne12);
        $sousligne13->setTravail($repository->findBy(['id'=>'3'])[0]);$ligne11->addSousligne($sousligne13);
        $sousligne14->setTravail($repository->findBy(['id'=>'4'])[0]);$ligne11->addSousligne($sousligne14);
        $sousligne15->setTravail($repository->findBy(['id'=>'5'])[0]);$ligne11->addSousligne($sousligne15);
        $sousligne16->setTravail($repository->findBy(['id'=>'6'])[0]);$ligne11->addSousligne($sousligne16);
        $sousligne17->setTravail($repository->findBy(['id'=>'7'])[0]);$ligne12->addSousligne($sousligne17);
        $sousligne18->setTravail($repository->findBy(['id'=>'8'])[0]);$ligne12->addSousligne($sousligne18);
        $sousligne19->setTravail($repository->findBy(['id'=>'9'])[0]);$ligne12->addSousligne($sousligne19);
        $sousligne110->setTravail($repository->findBy(['id'=>'10'])[0]);$ligne12->addSousligne($sousligne110);
        $sousligne111->setTravail($repository->findBy(['id'=>'11'])[0]);$ligne12->addSousligne($sousligne111);
        $sousligne112->setTravail($repository->findBy(['id'=>'12'])[0]);$ligne12->addSousligne($sousligne112);
        $sousligne113->setTravail($repository->findBy(['id'=>'13'])[0]);$ligne12->addSousligne($sousligne113);
        $sousligne114->setTravail($repository->findBy(['id'=>'14'])[0]);$ligne12->addSousligne($sousligne114);
        $sousligne115->setTravail($repository->findBy(['id'=>'15'])[0]);$ligne12->addSousligne($sousligne115);
        $sousligne116->setTravail($repository->findBy(['id'=>'16'])[0]);$ligne13->addSousligne($sousligne116);
        $sousligne117->setTravail($repository->findBy(['id'=>'17'])[0]);$ligne13->addSousligne($sousligne117);
        $sousligne118->setTravail($repository->findBy(['id'=>'18'])[0]);$ligne13->addSousligne($sousligne118);
        $sousligne119->setTravail($repository->findBy(['id'=>'19'])[0]);$ligne13->addSousligne($sousligne119);
        $sousligne120->setTravail($repository->findBy(['id'=>'20'])[0]);$ligne13->addSousligne($sousligne120);
        $sousligne121->setTravail($repository->findBy(['id'=>'21'])[0]);$ligne13->addSousligne($sousligne121);
        $sousligne122->setTravail($repository->findBy(['id'=>'22'])[0]);$ligne13->addSousligne($sousligne122);
        $sousligne123->setTravail($repository->findBy(['id'=>'23'])[0]);$ligne13->addSousligne($sousligne123);
        $sousligne124->setTravail($repository->findBy(['id'=>'24'])[0]);$ligne13->addSousligne($sousligne124);
        $sousligne125->setTravail($repository->findBy(['id'=>'25'])[0]);$ligne14->addSousligne($sousligne125);
        $sousligne126->setTravail($repository->findBy(['id'=>'26'])[0]);$ligne14->addSousligne($sousligne126);
        $sousligne127->setTravail($repository->findBy(['id'=>'27'])[0]);$ligne14->addSousligne($sousligne127);
        $sousligne21=new  Sousligne();
        $sousligne22=new  Sousligne();
        $sousligne23=new  Sousligne();
        $sousligne24=new  Sousligne();
        $sousligne25=new  Sousligne();
        $sousligne26=new  Sousligne();
        $sousligne27=new  Sousligne();
        $sousligne28=new  Sousligne();
        $sousligne29=new  Sousligne();
        $sousligne210=new  Sousligne();
        $sousligne211=new  Sousligne();
        $sousligne212=new  Sousligne();
        $sousligne213=new  Sousligne();
        $sousligne214=new  Sousligne();
        $sousligne215=new  Sousligne();
        $sousligne216=new  Sousligne();
        $sousligne217=new  Sousligne();
        $sousligne218=new  Sousligne();
        $sousligne219=new  Sousligne();
        $sousligne220=new  Sousligne();
        $sousligne221=new  Sousligne();
        $sousligne222=new  Sousligne();
        $sousligne223=new  Sousligne();
        $sousligne224=new  Sousligne();
        $sousligne225=new  Sousligne();
        $sousligne226=new  Sousligne();
        $sousligne227=new  Sousligne();
        
        $sousligne21->setTravail($repository->findBy(['id'=>'1'])[0]);$ligne21->addSousligne($sousligne21);
        $sousligne22->setTravail($repository->findBy(['id'=>'2'])[0]);$ligne21->addSousligne($sousligne22);
        $sousligne23->setTravail($repository->findBy(['id'=>'3'])[0]);$ligne21->addSousligne($sousligne23);
        $sousligne24->setTravail($repository->findBy(['id'=>'4'])[0]);$ligne21->addSousligne($sousligne24);
        $sousligne25->setTravail($repository->findBy(['id'=>'5'])[0]);$ligne21->addSousligne($sousligne25);
        $sousligne26->setTravail($repository->findBy(['id'=>'6'])[0]);$ligne21->addSousligne($sousligne26);
        $sousligne27->setTravail($repository->findBy(['id'=>'7'])[0]);$ligne22->addSousligne($sousligne27);
        $sousligne28->setTravail($repository->findBy(['id'=>'8'])[0]);$ligne22->addSousligne($sousligne28);
        $sousligne29->setTravail($repository->findBy(['id'=>'9'])[0]);$ligne22->addSousligne($sousligne29);
        $sousligne210->setTravail($repository->findBy(['id'=>'10'])[0]);$ligne22->addSousligne($sousligne210);
        $sousligne211->setTravail($repository->findBy(['id'=>'11'])[0]);$ligne22->addSousligne($sousligne211);
        $sousligne212->setTravail($repository->findBy(['id'=>'12'])[0]);$ligne22->addSousligne($sousligne212);
        $sousligne213->setTravail($repository->findBy(['id'=>'13'])[0]);$ligne22->addSousligne($sousligne213);
        $sousligne214->setTravail($repository->findBy(['id'=>'14'])[0]);$ligne22->addSousligne($sousligne214);
        $sousligne215->setTravail($repository->findBy(['id'=>'15'])[0]);$ligne22->addSousligne($sousligne215);
        $sousligne216->setTravail($repository->findBy(['id'=>'16'])[0]);$ligne23->addSousligne($sousligne216);
        $sousligne217->setTravail($repository->findBy(['id'=>'17'])[0]);$ligne23->addSousligne($sousligne217);
        $sousligne218->setTravail($repository->findBy(['id'=>'18'])[0]);$ligne23->addSousligne($sousligne218);
        $sousligne219->setTravail($repository->findBy(['id'=>'19'])[0]);$ligne23->addSousligne($sousligne219);
        $sousligne220->setTravail($repository->findBy(['id'=>'20'])[0]);$ligne23->addSousligne($sousligne220);
        $sousligne221->setTravail($repository->findBy(['id'=>'21'])[0]);$ligne23->addSousligne($sousligne221);
        $sousligne222->setTravail($repository->findBy(['id'=>'22'])[0]);$ligne23->addSousligne($sousligne222);
        $sousligne223->setTravail($repository->findBy(['id'=>'23'])[0]);$ligne23->addSousligne($sousligne223);
        $sousligne224->setTravail($repository->findBy(['id'=>'24'])[0]);$ligne23->addSousligne($sousligne224);
        $sousligne225->setTravail($repository->findBy(['id'=>'25'])[0]);$ligne24->addSousligne($sousligne225);
        $sousligne226->setTravail($repository->findBy(['id'=>'26'])[0]);$ligne24->addSousligne($sousligne226);
        $sousligne227->setTravail($repository->findBy(['id'=>'27'])[0]);$ligne24->addSousligne($sousligne227);

        $sousligne31=new  Sousligne();
        $sousligne32=new  Sousligne();
        $sousligne33=new  Sousligne();
        $sousligne34=new  Sousligne();
        $sousligne35=new  Sousligne();
        $sousligne36=new  Sousligne();
        $sousligne37=new  Sousligne();
        $sousligne38=new  Sousligne();
        $sousligne39=new  Sousligne();
        $sousligne310=new  Sousligne();
        $sousligne311=new  Sousligne();
        $sousligne312=new  Sousligne();
        $sousligne313=new  Sousligne();
        $sousligne314=new  Sousligne();
        $sousligne315=new  Sousligne();
        $sousligne316=new  Sousligne();
        $sousligne317=new  Sousligne();
        $sousligne318=new  Sousligne();
        $sousligne319=new  Sousligne();
        $sousligne320=new  Sousligne();
        $sousligne321=new  Sousligne();
        $sousligne322=new  Sousligne();
        $sousligne323=new  Sousligne();
        $sousligne324=new  Sousligne();
        $sousligne325=new  Sousligne();
        $sousligne326=new  Sousligne();
        $sousligne327=new  Sousligne();
        
        $sousligne31->setTravail($repository->findBy(['id'=>'1'])[0]);$ligne31->addSousligne($sousligne31);
        $sousligne32->setTravail($repository->findBy(['id'=>'2'])[0]);$ligne31->addSousligne($sousligne32);
        $sousligne33->setTravail($repository->findBy(['id'=>'3'])[0]);$ligne31->addSousligne($sousligne33);
        $sousligne34->setTravail($repository->findBy(['id'=>'4'])[0]);$ligne31->addSousligne($sousligne34);
        $sousligne35->setTravail($repository->findBy(['id'=>'5'])[0]);$ligne31->addSousligne($sousligne35);
        $sousligne36->setTravail($repository->findBy(['id'=>'6'])[0]);$ligne31->addSousligne($sousligne36);
        $sousligne37->setTravail($repository->findBy(['id'=>'7'])[0]);$ligne32->addSousligne($sousligne37);
        $sousligne38->setTravail($repository->findBy(['id'=>'8'])[0]);$ligne32->addSousligne($sousligne38);
        $sousligne39->setTravail($repository->findBy(['id'=>'9'])[0]);$ligne32->addSousligne($sousligne39);
        $sousligne310->setTravail($repository->findBy(['id'=>'10'])[0]);$ligne32->addSousligne($sousligne310);
        $sousligne311->setTravail($repository->findBy(['id'=>'11'])[0]);$ligne32->addSousligne($sousligne311);
        $sousligne312->setTravail($repository->findBy(['id'=>'12'])[0]);$ligne32->addSousligne($sousligne312);
        $sousligne313->setTravail($repository->findBy(['id'=>'13'])[0]);$ligne32->addSousligne($sousligne313);
        $sousligne314->setTravail($repository->findBy(['id'=>'14'])[0]);$ligne32->addSousligne($sousligne314);
        $sousligne315->setTravail($repository->findBy(['id'=>'15'])[0]);$ligne32->addSousligne($sousligne315);
        $sousligne316->setTravail($repository->findBy(['id'=>'16'])[0]);$ligne33->addSousligne($sousligne316);
        $sousligne317->setTravail($repository->findBy(['id'=>'17'])[0]);$ligne33->addSousligne($sousligne317);
        $sousligne318->setTravail($repository->findBy(['id'=>'18'])[0]);$ligne33->addSousligne($sousligne318);
        $sousligne319->setTravail($repository->findBy(['id'=>'19'])[0]);$ligne33->addSousligne($sousligne319);
        $sousligne320->setTravail($repository->findBy(['id'=>'20'])[0]);$ligne33->addSousligne($sousligne320);
        $sousligne321->setTravail($repository->findBy(['id'=>'21'])[0]);$ligne33->addSousligne($sousligne321);
        $sousligne322->setTravail($repository->findBy(['id'=>'22'])[0]);$ligne33->addSousligne($sousligne322);
        $sousligne323->setTravail($repository->findBy(['id'=>'23'])[0]);$ligne33->addSousligne($sousligne323);
        $sousligne324->setTravail($repository->findBy(['id'=>'24'])[0]);$ligne33->addSousligne($sousligne324);
        $sousligne325->setTravail($repository->findBy(['id'=>'25'])[0]);$ligne34->addSousligne($sousligne325);
        $sousligne326->setTravail($repository->findBy(['id'=>'26'])[0]);$ligne34->addSousligne($sousligne326);
        $sousligne327->setTravail($repository->findBy(['id'=>'27'])[0]);$ligne34->addSousligne($sousligne327);

        $sousligne41=new  Sousligne();
        $sousligne42=new  Sousligne();
        $sousligne43=new  Sousligne();
        $sousligne44=new  Sousligne();
        $sousligne45=new  Sousligne();
        $sousligne46=new  Sousligne();
        $sousligne47=new  Sousligne();
        $sousligne48=new  Sousligne();
        $sousligne49=new  Sousligne();
        $sousligne410=new  Sousligne();
        $sousligne411=new  Sousligne();
        $sousligne412=new  Sousligne();
        $sousligne413=new  Sousligne();
        $sousligne414=new  Sousligne();
        $sousligne415=new  Sousligne();
        $sousligne416=new  Sousligne();
        $sousligne417=new  Sousligne();
        $sousligne418=new  Sousligne();
        $sousligne419=new  Sousligne();
        $sousligne420=new  Sousligne();
        $sousligne421=new  Sousligne();
        $sousligne422=new  Sousligne();
        $sousligne423=new  Sousligne();
        $sousligne424=new  Sousligne();
        $sousligne425=new  Sousligne();
        $sousligne426=new  Sousligne();
        $sousligne427=new  Sousligne();
       
        $sousligne41->setTravail($repository->findBy(['id'=>'1'])[0]);$ligne41->addSousligne($sousligne41);
        $sousligne42->setTravail($repository->findBy(['id'=>'2'])[0]);$ligne41->addSousligne($sousligne42);
        $sousligne43->setTravail($repository->findBy(['id'=>'3'])[0]);$ligne41->addSousligne($sousligne43);
        $sousligne44->setTravail($repository->findBy(['id'=>'4'])[0]);$ligne41->addSousligne($sousligne44);
        $sousligne45->setTravail($repository->findBy(['id'=>'5'])[0]);$ligne41->addSousligne($sousligne45);
        $sousligne46->setTravail($repository->findBy(['id'=>'6'])[0]);$ligne41->addSousligne($sousligne46);
        $sousligne47->setTravail($repository->findBy(['id'=>'7'])[0]);$ligne42->addSousligne($sousligne47);
        $sousligne48->setTravail($repository->findBy(['id'=>'8'])[0]);$ligne42->addSousligne($sousligne48);
        $sousligne49->setTravail($repository->findBy(['id'=>'9'])[0]);$ligne42->addSousligne($sousligne49);
        $sousligne410->setTravail($repository->findBy(['id'=>'10'])[0]);$ligne42->addSousligne($sousligne410);
        $sousligne411->setTravail($repository->findBy(['id'=>'11'])[0]);$ligne42->addSousligne($sousligne411);
        $sousligne412->setTravail($repository->findBy(['id'=>'12'])[0]);$ligne42->addSousligne($sousligne412);
        $sousligne413->setTravail($repository->findBy(['id'=>'13'])[0]);$ligne42->addSousligne($sousligne413);
        $sousligne414->setTravail($repository->findBy(['id'=>'14'])[0]);$ligne42->addSousligne($sousligne414);
        $sousligne415->setTravail($repository->findBy(['id'=>'15'])[0]);$ligne42->addSousligne($sousligne415);
        $sousligne416->setTravail($repository->findBy(['id'=>'16'])[0]);$ligne43->addSousligne($sousligne416);
        $sousligne417->setTravail($repository->findBy(['id'=>'17'])[0]);$ligne43->addSousligne($sousligne417);
        $sousligne418->setTravail($repository->findBy(['id'=>'18'])[0]);$ligne43->addSousligne($sousligne418);
        $sousligne419->setTravail($repository->findBy(['id'=>'19'])[0]);$ligne43->addSousligne($sousligne419);
        $sousligne420->setTravail($repository->findBy(['id'=>'20'])[0]);$ligne43->addSousligne($sousligne420);
        $sousligne421->setTravail($repository->findBy(['id'=>'21'])[0]);$ligne43->addSousligne($sousligne421);
        $sousligne422->setTravail($repository->findBy(['id'=>'22'])[0]);$ligne43->addSousligne($sousligne422);
        $sousligne423->setTravail($repository->findBy(['id'=>'23'])[0]);$ligne43->addSousligne($sousligne423);
        $sousligne424->setTravail($repository->findBy(['id'=>'24'])[0]);$ligne43->addSousligne($sousligne424);
        $sousligne425->setTravail($repository->findBy(['id'=>'25'])[0]);$ligne44->addSousligne($sousligne425);
        $sousligne426->setTravail($repository->findBy(['id'=>'26'])[0]);$ligne44->addSousligne($sousligne426);
        $sousligne427->setTravail($repository->findBy(['id'=>'27'])[0]);$ligne44->addSousligne($sousligne427);

        $pfmp1->addLigne($ligne11);
        $pfmp1->addLigne($ligne12);
        $pfmp1->addLigne($ligne13);
        $pfmp1->addLigne($ligne14);
        $pfmp2->addLigne($ligne21);
        $pfmp2->addLigne($ligne22);
        $pfmp2->addLigne($ligne23);
        $pfmp2->addLigne($ligne24);
        $pfmp3->addLigne($ligne31);
        $pfmp3->addLigne($ligne32);
        $pfmp3->addLigne($ligne33);
        $pfmp3->addLigne($ligne34);
        $pfmp4->addLigne($ligne41);
        $pfmp4->addLigne($ligne42);
        $pfmp4->addLigne($ligne43);
        $pfmp4->addLigne($ligne44);
        $eleve->addCappfpmp($pfmp1);
        $eleve->addCappfpmp($pfmp2);
        $eleve->addCappfpmp($pfmp3);
        $eleve->addCappfpmp($pfmp4);
        $form = $this->createForm(EleveType::class, $eleve);
        $form->handleRequest($request);
        $repository = $this->getDoctrine()->getRepository( Utilisateur::class);
        $eleve->setAdmin($repository->findAll()[0]);
        $eleve->setEnseignant($repository->findAll()[0]);
        $pfmp1->setEnseignant("PAS");
        $pfmp2->setEnseignant("PAS");
        $pfmp3->setEnseignant("PAS");
        $pfmp4->setEnseignant("PAS");
        if ($form->isSubmitted() && $form->isValid()) {
           
             $entityManager->persist($eleve);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('admin_home');
        }

        return $this->render('administrateur/nouveleleve.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
        return $this->render('administrateur/moncompte.html.twig', []);

    }
      
   /**
     * @Route("/admin/{id}/affecterenseignant", name="affecterenseigneleve")
     */
    public function affecter(Eleve $user, Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    
    {
        $form = $this->createForm(AffecterenseigantType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password
             $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('listeeleves');
        }

        return $this->render('administrateur/affecterenseignant.html.twig', [
            'registrationForm' => $form->createView(),
            'eleve' =>$user
        ]);
        return $this->render('administrateur/moncompte.html.twig', []);

    }

}
