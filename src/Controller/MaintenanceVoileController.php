<?php

namespace App\Controller;

use App\Entity\MaintenanceVoile;
use App\Entity\Voile;
use App\Form\MaintenanceVoileType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maintenance/voile")
 */
class MaintenanceVoileController extends AbstractController
{

    /**
     * @Route("/new/{voileId}", name="maintenance_voile_new", methods={"GET","POST"})
     * @param $voileId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function newMaintenanceVoile($voileId,Request $request,EntityManagerInterface $manager): Response
    {
        $voile = $this->getDoctrine()->getRepository(Voile::class)
            ->findOneBy(['id' => $voileId]);

        $maintenanceVoile = new MaintenanceVoile();
        $form = $this->createForm(MaintenanceVoileType::class,$maintenanceVoile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maintenanceVoile->setVoile($voile);
            $maintenanceVoile->setCategorieMaintenance('voile');
            $manager->persist($maintenanceVoile);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'voiles']);
        }

        return $this->render(
            'maintenance_voile/new.html.twig',
            [
                'maintenance_voile' => $maintenanceVoile,
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * @Route("/{id}/edit", name="maintenance_voile_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaintenanceVoile $maintenanceVoile
     * @return Response
     */
    public function edit(Request $request,MaintenanceVoile $maintenanceVoile): Response
    {
        $form = $this->createForm(MaintenanceVoileType::class,$maintenanceVoile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home',[
                'id' => $maintenanceVoile->getId(),
                'rubrique' => 'voile'
            ]);
        }

        return $this->render(
            'maintenance_voile/edit.html.twig',
            [
                'maintenance_voile' => $maintenanceVoile,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="maintenance_voile_delete", methods={"POST"})
     * @param EntityManagerInterface $manager
     * @param MaintenanceVoile $maintenanceVoile
     * @return Response
     */
    public function delete(EntityManagerInterface $manager,MaintenanceVoile $maintenanceVoile): Response
    {
        $manager->remove($maintenanceVoile);
        $manager->flush();
        $this->addFlash('success', 'Maintenance de la voile supprimée !');
        return $this->redirectToRoute('home',['rubrique' => 'voiles']);
    }
}
