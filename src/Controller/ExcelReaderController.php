<?php

namespace App\Controller;

use App\Entity\Association;
use App\ExcelReader\SpreadsheetReader;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AssociationRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ExcelReaderController extends AbstractController
{
    #[Route('/excel/reader', name: 'excel.form')]
    public function index(): Response
    {
        return $this->render('excel_reader/index.html.twig');
    }

    #[Route('/excel/reader/submit', name: 'excel.submit')]
    public function submitExcel(Request $request, AssociationRepository $repository, EntityManagerInterface $em) {
        $skipHeader = true;
        $index = 1;
        $excelFile = $request->files->get('excel');
        $filePath = $this->getParameter('upload_excel');

        $fileName = uniqid() . '.' . $excelFile->guessExtension();

        $excelFile->move($filePath, $fileName);

        $targetDirectory = $filePath . "/" . $fileName;

        $reader = new SpreadsheetReader($targetDirectory);

        // dd($reader);

        foreach ($reader as $key => $row) {
            if ($skipHeader) {
                $skipHeader = false;
            } else {
                $association = $repository->find($index);

                $association->setNomPresident(($row[0]) ? $row[0] : "");
                $association->setNifStat(($row[1]) ? $row[1] : false);
                $association->setNumeroRecepisse(($row[2]) ? $row[2] : "");

                $em->persist($association);
                
                $index++;
            }
        }

        $em->flush();
        $this->addFlash(
           'success',
           'Insert in success'
        );

        return new JsonResponse([
            'info' => 'Success'
        ]);
    }
}