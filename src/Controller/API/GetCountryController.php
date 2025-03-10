<?php 

namespace App\Controller\API;

use App\Repository\DistrictRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class GetCountryController extends AbstractController {
    #[Route('/commune/{districtId}')]
    public function getAllCommune(DistrictRepository $districtRepository, int $districtId) {
        $communes = $districtRepository->findCommuneInDistrict($districtId);

        return $this->json($communes);
    }
}

?>