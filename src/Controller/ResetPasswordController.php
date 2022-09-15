<?php

namespace App\Controller;


use App\Form\ResetPasswordType;
use App\Repository\UserRepository;
use App\Repository\PartnersRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class ResetPasswordController extends AbstractController
{
    public function __construct(
        private UserPasswordHasherInterface $hasher
    )
    {}
    

    #[IsGranted('ROLE_USER')]
    #[Route('/redefinir-mon-mot-de-passe', name:'app_reset_password')]
    public function reset(
        Request $request, 
        UserRepository $userRepo, 
        EntityManagerInterface $entityManager,
        PartnersRepository $partnerRepo
        ): Response
    {
        $currentUser = $this->getUser();
        $user = $userRepo->findOneBy(["id" => $currentUser]);

        $partner = $partnerRepo->findOneBy(['clientId' => $this->getUser()]);

        $form = $this->createForm(ResetPasswordType::class, $user);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $password = $form->get('password')->getData();
            $hashedPassword = $this->hasher->hashPassword($user, $password);

            $user->setPassword($hashedPassword);

            $this->addFlash(
                'success',
                'Votre mot de passe a bien été modifié'
            );
        
            $entityManager->flush();
            


            if(in_array("ROLE_ADMIN", $user->getRoles())){
                return $this->RedirectToRoute('app_partner_list');
            }else {
                return $this->RedirectToRoute('app_home');
            }

        }


        return $this->renderForm('reset/reset-password.html.twig', [
            'form' => $form
        ]);
    }
}
