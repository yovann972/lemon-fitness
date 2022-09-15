<?php

namespace App\Controller;

use App\Repository\PartnersRepository;
use App\Repository\StructuresRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class homeController extends AbstractController
{
    /**
     * home
     *
     * @param  mixed $partnerRepo
     * @param  mixed $structureRepo
     * @return Response
     */
    #[Route('/', name: 'app_home')]    
    public function home(PartnersRepository $partnerRepo, StructuresRepository $structureRepo): Response
    {

        if ($this->getUser()) {

            $user = $this->getUser();

           if(in_array("ROLE_PARTNER", $user->getRoles())) {
                $partner = $partnerRepo->findOneBy(['clientId' => $user]);
                return $this->redirectToRoute('app_partner_profile',[
                    'id' => $partner
                ]);
           } elseif(in_array("ROLE_STRUCTURE", $user->getRoles())) {

                $structure = $structureRepo->findOneBy(['clientId' => $user]) ;
                return $this->redirectToRoute('app_structure_profile',[
                    'id' => $structure
                ]);
           } elseif(in_array("ROLE_ADMIN", $user->getRoles())){
                return $this->redirectToRoute('app_partner_list');
           }
        }

        return $this->render('home/landingPage.html.twig');
    }

}
