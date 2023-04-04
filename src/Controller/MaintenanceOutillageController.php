<?php

namespace App\Controller;

use App\Entity\Outillage;
use App\Entity\MaintenanceOutillage;
use App\Form\MaintenanceOutillageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maintenance/outillage")
 */
class MaintenanceOutillageController extends AbstractController
{

    /**
     * @Route("/new/{outillageId}", name="maintenance_outillage_new", methods={"GET","POST"})
     * @param $outillageId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new($outillageId,Request $request,EntityManagerInterface $manager): Response
    {
        /** @var object $outillage */
        $outillage = $this->getDoctrine()->getRepository(Outillage::class)
            ->findOneBy(array('id' => $outillageId));
        $maintenanceOutillage = new MaintenanceOutillage();
        $form = $this->createForm(MaintenanceOutillageType::class,$maintenanceOutillage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maintenanceOutillage->setOutillage($outillage);
            $maintenanceOutillage->setCategorieMaintenance('outillage');
            $manager->persist($maintenanceOutillage);
            $manager->flush();
            return $this->redirectToRoute('home',['rubrique' => 'outillage']);
        }

        return $this->render('maintenance_outillage/new.html.twig',[
                'maintenance_outillage' => $maintenanceOutillage,
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * @Route("/{id}/edit", name="maintenance_outillage_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaintenanceOutillage $maintenanceOutillage
     * @return Response
     */
    public function edit(Request $request,MaintenanceOutillage $maintenanceOutillage): Response
    {
        $form = $this->createForm(MaintenanceOutillageType::class,$maintenanceOutillage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home',['rubrique' => 'outillage']);
        }

        return $this->render('maintenance_outillage/edit.html.twig',[
            'maintenance_outillage' => $maintenanceOutillage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maintenance_outillage_delete", methods={"DELETE"})
     * @param Request $request
     * @param MaintenanceOutillage $maintenanceOutillage
     * @return Response
     */
    public function delete(Request $request,MaintenanceOutillage $maintenanceOutillage): Response
    {
        if ($this->isCsrfTokenValid('delete' . $maintenanceOutillage->getId(),$request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maintenanceOutillage);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home',['rubrique' => 'outillage']);
    }
}
