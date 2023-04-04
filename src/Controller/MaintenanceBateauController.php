<?php

namespace App\Controller;

use App\Entity\Bateau;
use App\Entity\MaintenanceBateau;
use App\Form\MaintenanceBateauType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maintenance/bateau")
 */
class MaintenanceBateauController extends AbstractController
{

    /**
     * @Route("/new/{bateauMaintenuId}", name="maintenance_bateau_new", methods={"GET","POST"})
     * @param Bateau $bateauMaintenuId object
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new(Bateau $bateauMaintenuId ,Request $request,EntityManagerInterface $manager): Response
    {
        /** @var object $bateauMaintenuId */
        $bateauMaintenuId = $this->getDoctrine()->getRepository(Bateau::class)
            ->findOneBy(array('id' => $bateauMaintenuId));

        $maintenanceBateau = new MaintenanceBateau();
        $form = $this->createForm(MaintenanceBateauType::class,$maintenanceBateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $maintenanceBateau->setBateauMaintenuId($bateauMaintenuId);
            $maintenanceBateau->setCategorieMaintenance('bateau');
            $manager->persist($maintenanceBateau);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'bateau']);
        }

        return $this->render(
            'maintenance_bateau/new.html.twig',
            [
                'maintenance_bateau' => $maintenanceBateau,
                'bateauIdentifiant' => $bateauMaintenuId,
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * @Route("/{id}/edit", name="maintenance_bateau_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaintenanceBateau $maintenanceBateau
     * @return Response
     */
    public function edit(Request $request,MaintenanceBateau $maintenanceBateau): Response
    {
        $form = $this->createForm(MaintenanceBateauType::class,$maintenanceBateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute(
                'home',['rubrique' => 'bateau']
            );
        }

        return $this->render(
            'maintenance_bateau/edit.html.twig',
            [
                'maintenance_bateau' => $maintenanceBateau,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="maintenance_bateau_delete", methods={"DELETE"})
     * @param Request $request
     * @param MaintenanceBateau $maintenanceBateau
     * @return Response
     */
    public function delete(Request $request,MaintenanceBateau $maintenanceBateau): Response
    {
        if ($this->isCsrfTokenValid('delete' . $maintenanceBateau->getId(),$request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($maintenanceBateau);
            $entityManager->flush();
        }
        return $this->redirectToRoute('home',['rubrique' => 'bateau']);
    }

}
