<?php

namespace App\Controller;

use App\Entity\Electricite;
use App\Entity\MaintenanceElectricite;
use App\Form\MaintenanceElectriciteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maintenance/electricite")
 */
class MaintenanceElectriciteController extends AbstractController
{

    /**
     * @Route("/new/{electriciteId}", name="maintenance_electricite_new", methods={"GET","POST"})
     * @param $electriciteId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new($electriciteId,Request $request,EntityManagerInterface $manager): Response
    {
        /** @var object $electricite */
        $electricite = $this->getDoctrine()->getRepository(Electricite::class)
            ->findOneBy(array('id' => $electriciteId));
        $maintenanceElectricite = new MaintenanceElectricite();
        $form = $this->createForm(MaintenanceElectriciteType::class,$maintenanceElectricite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maintenanceElectricite->setElectricite($electricite);
            $maintenanceElectricite->setCategorieMaintenance('electricite');
            $manager->persist($maintenanceElectricite);
            $manager->flush();
            return $this->redirectToRoute('home',['rubrique' => 'electricite']);
        }

        return $this->render('maintenance_electricite/new.html.twig',[
                'maintenance_electricite' => $maintenanceElectricite,
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * @Route("/{id}/edit", name="maintenance_electricite_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaintenanceElectricite $maintenanceElectricite
     * @return Response
     */
    public function edit(Request $request,MaintenanceElectricite $maintenanceElectricite): Response
    {
        $form = $this->createForm(MaintenanceElectriciteType::class,$maintenanceElectricite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home',['rubrique' => 'electricite']);
        }

        return $this->render('maintenance_electricite/edit.html.twig',[
            'maintenance_electricite' => $maintenanceElectricite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maintenance_electricite_delete", methods={"DELETE"})
     * @param Request $request
     * @param MaintenanceElectricite $maintenanceElectricite
     * @return Response
     */
    public function delete(Request $request,MaintenanceElectricite $maintenanceElectricite): Response
    {
        if ($this->isCsrfTokenValid('delete' . $maintenanceElectricite->getId(),$request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maintenanceElectricite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home',['rubrique' => 'electricite']);
    }
}
