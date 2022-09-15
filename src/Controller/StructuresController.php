<?php

namespace App\Controller;

use App\Entity\Structures;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class StructuresController extends AbstractController
{
    #[Route('/structures/{id<[0-9]+>}', name: 'app_structures')]
    #[ParamConverter(
        'structure',
        class: Structures::class
    )]
    public function index(Structures $structure): Response
    {
        return $this->render('structures/index.html.twig',compact('structure'));
    }
    
    #[Route('/mon-compte/structure/{id<[0-9]+>}', name:'app_structure_profile')]
    #[ParamConverter(
        'structure', 
        class: Structures::class,
        options: ['id' => 'id'],
    )]
    public function myAccount(Structures $structure): Response
    {
        $user = $this->getUser();

        if($structure->getClientId() == $user) {
            return $this->render('structures/index.html.twig',compact('structure'));
        }

        throw $this->createNotFoundException('Une erreur est survenue');
    }


}
