<?php

namespace App\Controller;

use App\Entity\Accastillage;
use App\Entity\MaintenanceAccastillage;
use App\Form\MaintenanceAccastillageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maintenance/accastillage")
 */
class MaintenanceAccastillageController extends AbstractController
{


    /**
     * @Route("/new/{accastillageId}", name="maintenance_accastillage_new", methods={"GET","POST"})
     * @param $accastillageId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function newMaintenanceAccastillage($accastillageId,Request $request,EntityManagerInterface $manager): Response
    {
        $accastillage = $this->getDoctrine()->getRepository(Accastillage::class)
            ->findOneBy(['id' => $accastillageId]);
        $maintenanceAccastillage = new MaintenanceAccastillage();
        $form = $this->createForm(MaintenanceAccastillageType::class,$maintenanceAccastillage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maintenanceAccastillage->setAccastillage($accastillage);
            $maintenanceAccastillage->setCategorieMaintenance('accastillage');
            $manager->persist($maintenanceAccastillage);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'accastillage']);
        }

        return $this->render('maintenance_accastillage/new.html.twig',[
            'maintenance_accastillage' => $maintenanceAccastillage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="maintenance_accastillage_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaintenanceAccastillage $maintenanceAccastillage
     * @return Response
     */
    public function edit(Request $request,MaintenanceAccastillage $maintenanceAccastillage): Response
    {
        $form = $this->createForm(MaintenanceAccastillageType::class,$maintenanceAccastillage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home',['rubrique' => 'accastillage']);
        }

        return $this->render('maintenance_accastillage/edit.html.twig',[
            'maintenance_accastillage' => $maintenanceAccastillage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maintenance_accastillage_delete", methods={"POST"})
     * @param Request $request
     * @param MaintenanceAccastillage $maintenanceAccastillage
     * @return Response
     */
    public function delete(Request $request,MaintenanceAccastillage $maintenanceAccastillage): Response
    {
        if ($this->isCsrfTokenValid('delete' . $maintenanceAccastillage->getId(),$request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maintenanceAccastillage);
            $entityManager->flush();
            $this->addFlash('success', 'Maintnance d\'accastillage a été supprimée !');
        }

        return $this->redirectToRoute('home',['rubrique' => 'accastillage']);
    }
}
