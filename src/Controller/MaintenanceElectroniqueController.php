<?php

namespace App\Controller;

use App\Entity\Accastillage;
use App\Entity\Electronique;
use App\Entity\MaintenanceElectronique;
use App\Form\MaintenanceElectroniqueType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maintenance/electronique")
 */
class MaintenanceElectroniqueController extends AbstractController
{
    /**
     * @Route("/new/{electroniqueId}", name="maintenance_electronique_new", methods={"GET","POST"})
     * @param $electroniqueId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new($electroniqueId,Request $request,EntityManagerInterface $manager): Response
    {


        /** @var object $electronique */
        $electronique = $this->getDoctrine()->getRepository(Electronique::class)
            ->findOneBy(['id' => $electroniqueId]);
        $maintenanceElectronique = new MaintenanceElectronique();
        $form = $this->createForm(MaintenanceElectroniqueType::class,$maintenanceElectronique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var object $maintenanceElectronique */
            $maintenanceElectronique->setElectronique($electronique);
            $maintenanceElectronique->setCategorieMaintenance('electronique');
            $manager->persist($maintenanceElectronique);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'electronique']);
        }

        return $this->render('maintenance_electronique/new.html.twig',[
            'maintenance_electronique' => $maintenanceElectronique,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="maintenance_electronique_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaintenanceElectronique $maintenanceElectronique
     * @return Response
     */
    public function edit(Request $request,MaintenanceElectronique $maintenanceElectronique): Response
    {
        $form = $this->createForm(MaintenanceElectroniqueType::class,$maintenanceElectronique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home',['rubrique' => 'electronique']);
        }
        return $this->render('maintenance_electronique/edit.html.twig',[
            'maintenance_electronique' => $maintenanceElectronique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="maintenance_electronique_delete", methods={"POST"})
     * @param Request $request
     * @param MaintenanceElectronique $maintenanceElectronique
     * @return Response
     */
    public function delete(Request $request,MaintenanceElectronique $maintenanceElectronique): Response
    {
        if ($this->isCsrfTokenValid('delete' . $maintenanceElectronique->getId(),$request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maintenanceElectronique);
            $entityManager->flush();
        }
        return $this->redirectToRoute('home',['rubrique' => 'electronique']);
    }
}
