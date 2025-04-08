<?php 

namespace App\Controller\API;

use App\Repository\EmployeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EmployeController extends AbstractController {

    #[Route("/api/employee")]
    public function getEmployeeInformation(EmployeRepository $repository) {
        $employees = $repository->findAll();

        return $this->json([
            $employees
        ]);
    }

}

?>