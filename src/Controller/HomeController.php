<?php

namespace App\Controller;

use App\Repository\RegionRepository;
use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{   
    #[Route('/', name: 'home')]
    public function index(AssociationRepository $repository, RegionRepository $regionRepo, Request $request): Response {
        if($this->denyAccessUnlessGranted('IS_AUTHENTICATED')) {
            return $this->redirectToRoute('app_login');
        }

        $totalAssociation = $repository->findTotalCountOfAssociation();
        $totalAssociationInCommune = $repository->findTotalCountInCommune();
        $regions = $regionRepo->findAll();

        return $this->render('dashboard/index.html.twig', [
            'totalAssociation' => $totalAssociation,
            'regions' => $regions,
            'totalAssociationInCommune' => $totalAssociationInCommune
        ]);
    }

    
}