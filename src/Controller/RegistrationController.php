<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Partners;
use App\Entity\Structures;
use App\Entity\Permissions;
use App\Form\AddPartnerType;
use App\Form\AddStructureType;
use App\Form\RegistrationFormType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationController extends AbstractController
{
    #[Route('/inscription', name: 'app_register')]
    public function register(Request $request, UserPasswordHasherInterface $userPasswordHasher, EntityManagerInterface $entityManager): Response
    {
        $user = new User();
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

            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email

            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
        ]);
    }


    /**
     * register Partner
     *
     * @return void
     */
    #[Route('/inscrire-un-partenaire', name: 'app_register_partner')]    
    public function registerPartner(
        SluggerInterface $slugger, 
        Request $request, 
        UserPasswordHasherInterface $userPasswordHasher, 
        EntityManagerInterface $entityManager,
        MailerInterface $mailer
        ): Response
    {
        $user = new User();
        $partner = new Partners();
        $form = $this->createForm(AddPartnerType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(["ROLE_PARTNER"]);

            $partner->setClientId($user);
            $partner->setName($form->get('name')->getData());
            $partner->setShortDescription($form->get('shortDescription')->getData());
            $partner->setLongDescription($form->get('longDescription')->getData());
            $partner->setActive($form->get('active')->getData());


            //Manage logo of partner
            $logoFile = $form->get('picture')->getData();

            if ($logoFile) {
                $originalFilename = pathinfo($logoFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$logoFile->guessExtension();

                // Move the file to the directory where brochures are stored
                try {
                    $logoFile->move(
                        $this->getParameter('logo_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }
                $partner->setLogo($newFilename);


                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
            }

            $password = $form->get('plainPassword')->getData();

            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            

            $entityManager->persist($user);
            $entityManager->persist($partner);
            $entityManager->flush();

            // Send an email
            $email = (new TemplatedEmail())
            ->from('lemonfitness@orange.fr')
            ->to($user->getEmail())
            ->subject('Lemon Fitness: votre compte partenaire')
            ->htmlTemplate('emails/welcome-mail.html.twig')
            ->context([
                'password' => $password
                ]);

                
        $mailer->send($email);


            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/add-partner.html.twig', [
            'partnerForm' => $form->createView(),
        ]);
    }


    /**
     * register Structure
     *
     * @param  mixed $request
     * @return void
     */
    #[Route('/inscrire-une-salle', name: 'app_register_structure')]    
    public function registerStructure(Request $request, 
    UserPasswordHasherInterface $userPasswordHasher, 
    EntityManagerInterface $entityManager,
    MailerInterface $mailer
    ): Response
    {
        $user = new User();
        $structure = new Structures();
        $perm = new Permissions();
        $form = $this->createForm(AddStructureType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setRoles(["ROLE_STRUCTURE"]);

            $structure->setClientId($user);
            $structure->setAddress($form->get('address')->getData());
            $structure->setcity($form->get('city')->getData());
            $structure->setZipCode($form->get('zipCode')->getData());
            $structure->setPartnerId($form->get('partnerId')->getData());

            //Permissions
            $perm->setInstallId($structure);
            $perm->setSellDrinks($form->get('sellDrinks')->getData());
            $perm->setMembersStatistiques($form->get('membersStat')->getData());
            $perm->setPaymentSchedules($form->get('paymentSchedules')->getData());
            $perm->setEmployeePlanning($form->get('employeePlanning')->getData());

            $password = $form->get('plainPassword')->getData();


            // encode the plain password
            $user->setPassword(
                $userPasswordHasher->hashPassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
        
            $entityManager->persist($user);
            $entityManager->persist($perm);
            $entityManager->persist($structure);
            $entityManager->flush();

            // Send an email
            $email = (new TemplatedEmail())
            ->from('lemonfitness@orange.fr')
            ->to($user->getEmail())
            ->subject('Lemon Fitness: votre compte partenaire')
            ->htmlTemplate('emails/welcome-mail.html.twig')
            ->context([
                'password' => $password
                ]);

                
            $mailer->send($email);


            return $this->redirectToRoute('app_login');
        }

        return $this->render('registration/add-structure.html.twig', [
            'structureForm' => $form->createView(),
        ]);
    }

}
