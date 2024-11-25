<?php 

namespace App\Controller\API;

use App\Repository\AssociationRepository;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/api')]
class BesoinAssociationController extends AbstractController {

    #[Route('/besoin/{regionId}')]
    public function selectRegionNeeded(AssociationRepository $repository,int $regionId) {
        $besoins = $repository->getNeededOfAssociation($regionId);

        return $this->json($besoins);
    }

}

?>