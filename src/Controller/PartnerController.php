<?php

namespace App\Controller;

use App\Entity\Partners;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class PartnerController extends AbstractController
{

    #[IsGranted('ROLE_USER')]
    /**
     * Return partnerPage 
     *
     * @param  $partner
     * @return Response
     */
    #[Route('/partenaire/{id<[0-9]+>}', name: 'app_partner')]
    #[ParamConverter(
        'partner', 
        class: Partners::class 
    )]    
    public function index(Partners $partner): Response
    {  
        return $this->render('partner/index.html.twig',compact('partner'));
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/partenaire/{page?1}/{nbre?4}', name:'app_partner_list')]
    public function FunctionName(ManagerRegistry $doctrine, $page, $nbre): Response
    {
        $repository = $doctrine->getManager()->getRepository(Partners::class);
        $nbPartner = $repository->count([]);
        $nbrePage = ceil($nbPartner / $nbre);
        $partners = $repository->findBy([], [], $nbre, ($page -1) * $nbre);

        return $this->render('partner/partner-list.html.twig', [
            'partners' => $partners,
            'isPaginated' => true,
            'nbrePage' => $nbrePage,
            'page' => $page,
            'nbre' => $nbre
        ]);
    }


    #[IsGranted('ROLE_USER')]
    /**
     * Route for activate a Partner
     *
     * @param  $partner
     * @param  $entityManager
     * @return json
     */
    #[Route('/partner/{id<[0-9]+>}/actif', name:'app_partner_active')]    
    public function activePartner(Partners $partner, EntityManagerInterface $entityManager): Response
    {  
        $user = $this->getUser();

        if (!$user) {
            return $this->json([
                'code'=> 403,
                'message' => 'Vous n\'etes pas authorisé'
            ],403);
        }

        if ($partner->isActive()) {

            $partner->setActive(false);
            
            $entityManager->persist($partner);
            $entityManager->flush();

            return $this->json([
                'code'=> 200,
                'message' => 'Partenaire désactivé'
            ],200);

        }

        $partner->setActive(true);
            
        $entityManager->persist($partner);
        $entityManager->flush();


        return $this->json([
            'code'=> 200,
            'message' => 'Partenaire activé'
        ], 200);
    }

 
    #[IsGranted('ROLE_USER')]
    /**
     * PartnerAccount
     *
     * @param  $partner
     * @return Response
     */
    #[Route('/mon-compte/partenaire/{id<[0-9]+>}', name:'app_partner_profile')]
    #[ParamConverter(
        'partner', 
        class: Partners::class,
        options: ['id' => 'id'],
    )]    
    public function myAccount(Partners $partner): Response
    {
        $user = $this->getUser();

        if($partner->getClientId() == $user) {
            return $this->render('partner/index.html.twig',compact('partner'));
        }

        throw $this->createNotFoundException('Une erreur est survenue');
    }

}
