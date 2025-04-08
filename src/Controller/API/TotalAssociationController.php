<?php 

namespace App\Controller\API;

use App\Helper\Helper;
use App\Repository\DistrictRepository;
use App\Repository\AssociationRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class TotalAssociationController extends AbstractController {

    private function getDataArray(AssociationRepository $repository, ?int $regionId) {
        $helper = new Helper();

        // Trouver le nombre total d'association
        $totalAssociation = $repository->findTotalCountOfAssociation();

        $total = $repository->findTotalCountOfAssociation();
        if ($regionId != null) {
            $total = $repository->findTotalCountInRegion($regionId)[0];
        }

        // Obtenir la densité des associations par region
        $associationDensity = $repository->getAssociationDensity($regionId);

        // Obtenir les pourcentages d'association normaliser par region
        $normalizeArray = $repository->getPercentageOfNormalizeAssociation($regionId);

        // Traiter la variable normalizeArray en pourcentage
        $percentageWithPresident = $helper->toPercentage($normalizeArray["nom_president"], $totalAssociation["total"]);
        $percentageWithNifStat = $helper->toPercentage($normalizeArray["nif_stat"], $totalAssociation["total"]);
        $percentageWithNumeroRecepisse = $helper->toPercentage($normalizeArray["numero_recepisse"], $totalAssociation["total"]);

        $percentageNormalizeArray = [
            "percentageWithPresident" => $percentageWithPresident,
            "percentageWithNifStat" => $percentageWithNifStat,
            "percentageWithNumeroRecepisse" => $percentageWithNumeroRecepisse];

        $dataArray = [
            $total,
            $percentageNormalizeArray,
            $associationDensity
        ];

        return $dataArray;
    }

    #[Route('/total')]
    public function totalAssociation(AssociationRepository $repository) {
        $dataArray = $this->getDataArray($repository, null);

        return $this->json($dataArray);
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
        $dataArray = $this->getDataArray($repository, $regionId);

        return $this->json($dataArray);
    }

    #[Route('/total/district/{districtId}')]
    public function totalAssociationInDistrict(AssociationRepository $repository, int $districtId) {
        $totalDistrict = $repository->findTotalCountInDistrict($districtId);

        return $this->json($totalDistrict);
    }

}

?>