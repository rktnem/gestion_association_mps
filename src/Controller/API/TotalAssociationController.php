<?php 

namespace App\Controller\API;

use App\Repository\DistrictRepository;
use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class TotalAssociationController extends AbstractController {

    #[Route('/total')]
    public function totalAssociation(AssociationRepository $repository) {
        $total = $repository->findTotalCountOfAssociation();

        return $this->json($total);
    }

    #[Route('/district/{regionId}')]
    public function selectRegionToShowDistrict(DistrictRepository $repository, int $regionId) {
        $district = $repository->findDistrictWithRegionId($regionId);

        return $this->json($district, 200, [], [
            'groups' => ['district.select']
        ]);
    }

    #[Route('/total/region/{regionId}')]
    public function totalAssociationInRegion(AssociationRepository $repository, int $regionId) {
        $totalInRegion = $repository->findTotalCountInRegion($regionId);

        return $this->json($totalInRegion);
    }

    #[Route('/total/district/{districtId}')]
    public function totalAssociationInDistrict(AssociationRepository $repository, int $districtId) {
        $totalDistrict = $repository->findTotalCountInDistrict($districtId);

        return $this->json($totalDistrict);
    }

}

?>