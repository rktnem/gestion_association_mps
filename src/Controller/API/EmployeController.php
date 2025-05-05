<?php 

namespace App\Controller\API;

use App\Repository\EmployesRepository;
use App\Repository\ServicesDirectionsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EmployeController extends AbstractController {

    #[Route("/api/employee/{matricule}")]
    public function getEmployeeInformation(EmployesRepository $employesRepository, 
        ServicesDirectionsRepository $sdRepository, string $matricule) 
    {
        $employe = $employesRepository->findEmployeByMatricule($matricule);
        $direction = $employe ? $sdRepository->findDirectionById($employe["serviceId"]) : null;

        return $this->json([
            $employe,
            $direction
        ]);
    }

}

?>