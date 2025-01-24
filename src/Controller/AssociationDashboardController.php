<?php

namespace App\Controller;

use App\Helper\Helper;
use App\Repository\BesoinRepository;
use App\Repository\RegionRepository;
use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AssociationDashboardController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(AssociationRepository $associationRepository, RegionRepository $regionRepository, 
                            BesoinRepository $besoinRepository, Request $request): Response {
        $helper = new Helper();

        if($this->denyAccessUnlessGranted('IS_AUTHENTICATED')) {
            return $this->redirectToRoute('app_login');
        }

        $totalAssociation = $associationRepository->findTotalCountOfAssociation();
        $totalAssociationInCommune = $associationRepository->findTotalCountInCommune();
        $regions = $regionRepository->findAll();
        $besoins = $associationRepository->getNeededOfAssociation();
        $normalizeArray = $associationRepository->getPercentageOfNormalizeAssociation();
        $associations = $associationRepository->getAssociationDensity();

        // Traiter la variable normalizeArray
        $percentageWithPresident = $helper->toPercentage($normalizeArray["nom_president"], $totalAssociation["total"]);
        $percentageWithNifStat = $helper->toPercentage($normalizeArray["nif_stat"], $totalAssociation["total"]);
        $percentageWithNumeroRecepisse = $helper->toPercentage($normalizeArray["numero_recepisse"], $totalAssociation["total"]);

        $percentageNormalizeArray = [
            "percentageWithPresident" => $percentageWithPresident,
            "percentageWithNifStat" => $percentageWithNifStat,
            "percentageWithNumeroRecepisse" => $percentageWithNumeroRecepisse];

        return $this->render('association_dashboard/index.html.twig', [
            'totalAssociation' => $totalAssociation,
            'totalAssociationInCommune' => $totalAssociationInCommune,
            'associations' => $associations,
            'regions' => $regions,
            'besoins' => $besoins,
            "percentageNormalizeArray" => $percentageNormalizeArray,
        ]);
    }
}