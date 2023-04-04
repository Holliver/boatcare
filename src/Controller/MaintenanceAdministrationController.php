<?php

namespace App\Controller;

use App\Entity\Administration;
use App\Entity\MaintenanceAdministration;
use App\Form\MaintenanceAdministrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maintenance/administration")
 */
class MaintenanceAdministrationController extends AbstractController
{

    /**
     * @Route("/new/{administrationId}", name="maintenance_administration_new", methods={"GET","POST"})
     * @param $administrationId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new($administrationId,
                        Request $request,
                        EntityManagerInterface $manager): Response
    {
        $administration = $this->getDoctrine()->getRepository(Administration::class)
            ->findOneBy(array('id' => $administrationId));
        $ma = new MaintenanceAdministration();
        $form = $this->createForm(MaintenanceAdministrationType::class, $ma);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $ma->setAdministration($administration);
            $ma->setCategorieMaintenance('administration');
            $manager->persist($ma);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'administration']);
        }
        return $this->render(
            'maintenance_administration/new.html.twig',
            [
                'operation'=>$ma,
                'form' => $form->createView(),
            ]
        );


    }


    /**
     * @Route("/{id}/edit", name="maintenance_administration_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaintenanceAdministration $maintenanceAdministration
     * @return Response
     */
    public function edit(Request $request,MaintenanceAdministration $maintenanceAdministration): Response
    {
        $form = $this->createForm(MaintenanceAdministrationType::class,$maintenanceAdministration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home',['rubrique' => 'administration']);
        }

        return $this->render('maintenance_administration/echeanceFormAdministration.html.twig',
            [
                'maintenance_administration' => $maintenanceAdministration,
                'form' => $form->createView(),
            ]);
    }

    /**
     * @Route("/{id}", name="maintenance_administration_delete", methods={"DELETE"})
     * @param Request $request
     * @param MaintenanceAdministration $maintenanceAdministration
     * @return Response
     */
    public function delete(Request $request,MaintenanceAdministration $maintenanceAdministration): Response
    {
        if ($this->isCsrfTokenValid('delete' . $maintenanceAdministration->getId(),$request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maintenanceAdministration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home',['rubrique' => 'administration']);
    }

}
