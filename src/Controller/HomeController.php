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

class HomeController extends AbstractController
{   
    #[Route('/', name: 'app_home')]
    public function index(): Response {
        return $this->render("home/index.html.twig");
    }   
}