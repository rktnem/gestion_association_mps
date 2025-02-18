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
                $markersData[] = [
                    'id' => $district->getId(),
                    'lat' => $district->getLatitude(),
                    'lng' => $district->getLongitude(),
                ];
            }
        }

        return $markersData;
    }
}