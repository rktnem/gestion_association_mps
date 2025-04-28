<?php

namespace App\Controller;

use App\Helper\Helper;
use DateTimeImmutable;
use App\Entity\Association;
use App\Form\AssociationType;
use App\Controller\MapController;
use App\Repository\BesoinRepository;
use App\Repository\RegionRepository;
use App\Repository\DistrictRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AssociationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/association-femmes', name: 'association_femme.')]
class AssociationFemmeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(AssociationRepository $associationRepository, RegionRepository $regionRepository, DistrictRepository $districtRepository,
        Request $request, EntityManagerInterface $em): Response {
        $helper = new Helper();
        $mapController = new MapController();
        $association = new Association();

        if($this->denyAccessUnlessGranted('IS_AUTHENTICATED')) {
            return $this->redirectToRoute('app_login');
        }

        $totalAssociation = $associationRepository->findTotalCountOfAssociation();
        // $totalAssociationInCommune = $associationRepository->findTotalCountInCommune();
        $regions = $regionRepository->findAll();
        // $besoins = $associationRepository->getNeededOfAssociation();
        $normalizeArray = $associationRepository->getPercentageOfNormalizeAssociation();
        $associations = $associationRepository->findAllNotDeleted();
        $associationDensity = $associationRepository->getAssociationDensity();
        $mapData = $mapController->showMap($districtRepository);

        // Traiter la variable normalizeArray en pourcentage
        $percentageWithPresident = $helper->toPercentage($normalizeArray["nom_president"], $totalAssociation["total"]);
        $percentageWithNifStat = $helper->toPercentage($normalizeArray["nif_stat"], $totalAssociation["total"]);
        $percentageWithNumeroRecepisse = $helper->toPercentage($normalizeArray["numero_recepisse"], $totalAssociation["total"]);

        $percentageNormalizeArray = [
            "percentageWithPresident" => $percentageWithPresident,
            "percentageWithNifStat" => $percentageWithNifStat,
            "percentageWithNumeroRecepisse" => $percentageWithNumeroRecepisse];

        // Création du formulaire pour la création d'association
        $formAssociation = $this->createForm(AssociationType::class, $association);

        // Appel à l'action du création d'association
        $formAssociation->handleRequest($request);
        
        if($formAssociation->isSubmitted() && $formAssociation->isValid()) {
            $em->persist($association);
            $em->flush();
            $this->addFlash(
                'success',
                'L\'ajout de nouvelle association à été un succés.'
            );

            return $this->redirectToRoute("association_femme.home");
        }
        else if ($formAssociation->isSubmitted() && !$formAssociation->isValid()) {
            $this->addFlash(
                'danger create-error',
                "L'ajout de nouvelle association fût un echec."
            );

            return $this->render('association_femme/index.html.twig', [
                'totalAssociation' => $totalAssociation,
                // 'totalAssociationInCommune' => $totalAssociationInCommune,
                'associationDensity' => $associationDensity,
                'regions' => $regions,
                // 'besoins' => $besoins,
                "percentageNormalizeArray" => $percentageNormalizeArray,
                "markersData" => $mapData,
                "associations" => $associations,
                "form" => $formAssociation,
            ]);
        }
        
        return $this->render('association_femme/index.html.twig', [
            'totalAssociation' => $totalAssociation,
            // 'totalAssociationInCommune' => $totalAssociationInCommune,
            'associationDensity' => $associationDensity,
            'regions' => $regions,
            // 'besoins' => $besoins,
            "percentageNormalizeArray" => $percentageNormalizeArray,
            "markersData" => $mapData,
            "associations" => $associations,
            "form" => $formAssociation,
        ]);
    }

    #[Route('/edit/{id}', name: 'edit')]
    public function edit(Association $association, Request $request, EntityManagerInterface $em): Response {
        $form = $this->createForm(AssociationType::class, $association);
        
        $form->handleRequest($request);
        
        if ($form->isSubmitted() && $form->isValid()) {
            $em->flush();
            $this->addFlash(
               'success',
               "Modification de l'association effectué a été un succés."
            );

            return $this->redirectToRoute('association_femme.home');
        }

        return $this->render('association_femme/admin/edit.html.twig', [
            'form' => $form
        ]);
    }

    #[Route('/delete/{id}', name: 'delete')]
    public function delete(Association $association, EntityManagerInterface $em): Response {
        $association->setDeletedAt(new DateTimeImmutable());
        $em->persist($association);
        $em->flush();
        $this->addFlash(
            'danger',
            "Une association vient d'être supprimé."
        );
        
        return $this->redirectToRoute('association_femme.home');
    }
}