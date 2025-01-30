<?php

namespace App\Controller;

use App\Repository\DistrictRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Map\Map;
use Symfony\UX\Map\Marker;
use Symfony\UX\Map\Point;

class MapController extends AbstractController
{
    public function showMap(DistrictRepository $districtRepository): Array {
        $districts = $districtRepository->findAllWithAssociations();

        $markersData = [];
        foreach ($districts as $district) {
            if (is_numeric($district->getLatitude()) && is_numeric($district->getLongitude())) {
                $popupContent = "<b>District: {$district->getNom()}</b><br><ul>";
                
                foreach ($district->getCommunes() as $commune) {
                    foreach ($commune->getAssociations() as $association) {
                        $membres = $association->getMembre();
                        $activite = $association->getActivite();
                        $besoins = $association->getBesoin()->isEmpty()
                            ? 'Aucun besoin spécifié'
                            : implode(', ', $association->getBesoin()->map(fn($b) => $b->getNomBesoin())->toArray());

                        $popupContent .= "<li>
                            <b>Nom:</b> {$association->getNom()}<br>
                            <b>Membres:</b> {$membres}<br>
                            <b>Activité:</b> {$activite}<br>
                            <b>Besoins:</b> {$besoins}
                        </li>";
                    }
                }

                $popupContent .= "</ul>";

                $markersData[] = [
                    'lat' => $district->getLatitude(),
                    'lng' => $district->getLongitude(),
                    'popup' => $popupContent,
                ];
            }
        }

        return $markersData;
    }

    #[Route('/map', name: 'app_map')]
    public function index(DistrictRepository $districtRepository): Response
    {
        $districts = $districtRepository->findAllWithAssociations();

        $markersData = [];
        foreach ($districts as $district) {
            if (is_numeric($district->getLatitude()) && is_numeric($district->getLongitude())) {
                $popupContent = "<b>District: {$district->getNom()}</b><br><ul>";
                
                foreach ($district->getCommunes() as $commune) {
                    foreach ($commune->getAssociations() as $association) {
                        $membres = $association->getMembre();
                        $activite = $association->getActivite();
                        $besoins = $association->getBesoin()->isEmpty()
                            ? 'Aucun besoin spécifié'
                            : implode(', ', $association->getBesoin()->map(fn($b) => $b->getNomBesoin())->toArray());

                        $popupContent .= "<li>
                            <b>Nom:</b> {$association->getNom()}<br>
                            <b>Membres:</b> {$membres}<br>
                            <b>Activité:</b> {$activite}<br>
                            <b>Besoins:</b> {$besoins}
                        </li>";
                    }
                }

                $popupContent .= "</ul>";

                $markersData[] = [
                    'lat' => $district->getLatitude(),
                    'lng' => $district->getLongitude(),
                    'popup' => $popupContent,
                ];
            }
        }

        return $this->render('map/index.html.twig', [
            'markersData' => $markersData,
        ]);
    }
}