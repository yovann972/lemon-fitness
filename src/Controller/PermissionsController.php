<?php

namespace App\Controller;

use App\Entity\Structures;
use App\Entity\Permissions;
use App\Form\PermissionsType;
use App\Repository\PartnersRepository;
use App\Repository\StructuresRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\PermissionsRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PermissionsController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    /**
     *  Route for partner for change sellDrink permissions
     *
     * @param  $id
     * @param  $permissionsRepo
     * @param  $partnerRepo
     * @param  $StructureRepo
     * @return json
     */
    #[Route('/active/{id}/vente-de-boisson')]    
    public function sellDrink($id, PermissionsRepository $permissionsRepo, PartnersRepository $partnerRepo, StructuresRepository $StructureRepo, 
    EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $partner = $partnerRepo->findOneBy(['clientId' => $user]);
        // $structure = $StructureRepo->findOneBy(['partnerId' => $partner]);
        $permission = $permissionsRepo->findOneBy(['installId'=> $id]);

        if($permission->isSellDrinks()){
            $permission->setSellDrinks(false);

            $em->flush();
            Return $this->json([
                'message' => 'désactivé'
            ],200);
        }

        $permission->setSellDrinks(true);
        $em->flush();

        Return $this->json([
            'message' => 'activé'
        ],200);
    }

    #[IsGranted('ROLE_USER')]
    /**
     * Route for partner for change memberStat permissions
     *
     * @param $id
     * @param $permissionsRepo
     * @param $partnerRepo
     * @param $StructureRepo
     * @return json
     */
    #[Route('/active/{id}/statistique-des-membres')]    
    public function memberStat($id, PermissionsRepository $permissionsRepo, PartnersRepository $partnerRepo, StructuresRepository $StructureRepo, 
    EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $partner = $partnerRepo->findOneBy(['clientId' => $user]);
        // $structure = $StructureRepo->findOneBy(['partnerId' => $partner]);
        $permission = $permissionsRepo->findOneBy(['installId'=> $id]);

        if($permission->isMembersStatistiques()){
            $permission->setMembersStatistiques(false);

            $em->flush();
            Return $this->json([
                'message' => 'désactivé'
            ],200);
        }

        $permission->setMembersStatistiques(true);
        $em->flush();

        Return $this->json([
            'message' => 'activé'
        ],200);
    }

    #[IsGranted('ROLE_USER')]
    /**
     * Route for partner for change payementSchedule permissions
     *
     * @param  mixed $id
     * @param  mixed $permissionsRepo
     * @param  mixed $partnerRepo
     * @param  mixed $StructureRepo
     * @return json
     */
    #[Route('/active/{id}/calendrier-de-payement')]    
    public function payementSchedule($id, PermissionsRepository $permissionsRepo, PartnersRepository $partnerRepo, StructuresRepository $StructureRepo, 
    EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $partner = $partnerRepo->findOneBy(['clientId' => $user]);
        // $structure = $StructureRepo->findOneBy(['partnerId' => $partner]);
        $permission = $permissionsRepo->findOneBy(['installId'=> $id]);

        if($permission->isPaymentSchedules()){
            $permission->setPaymentSchedules(false);

            $em->flush();
            Return $this->json([
                'message' => 'désactivé'
            ],200);
        }

        $permission->setPaymentSchedules(true);
        $em->flush();

        Return $this->json([
            'message' => 'activé'
        ],200);
    }    

    #[IsGranted('ROLE_USER')]
    /**
     * Route for partner for change employeePlanning permissions
     *
     * @param  mixed $id
     * @param  mixed $permissionsRepo
     * @param  mixed $partnerRepo
     * @param  mixed $StructureRepo
     * @return void
     */
    #[Route('/active/{id}/planning-employes')]    
    public function employeePlanning($id, PermissionsRepository $permissionsRepo, PartnersRepository $partnerRepo, StructuresRepository $StructureRepo, 
    EntityManagerInterface $em): Response
    {
        $user = $this->getUser();

        $partner = $partnerRepo->findOneBy(['clientId' => $user]);
        // $structure = $StructureRepo->findOneBy(['partnerId' => $partner]);
        $permission = $permissionsRepo->findOneBy(['installId'=> $id]);

        if($permission->isEmployeePlanning()){
            $permission->setEmployeePlanning(false);

            $em->flush();
            Return $this->json([
                'message' => 'désactivé'
            ],200);
        }   

        $permission->setEmployeePlanning(true);
        $em->flush();

        Return $this->json([
            'message' => 'activé'
        ],200);
    }    


}
