<?php

namespace App\Controller;

use App\Entity\MaintenanceMoteur;
use App\Entity\Moteur;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\{MaintenanceMoteurType};
use App\Repository\MaintenanceMoteurRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/maintenance/moteur")
 */
class MaintenanceMoteurController extends AbstractController
{

    /**
     * @Route("/new/{moteurIdId}", name="maintenance_moteur_new", methods={"GET","POST"})
     * @param $moteurIdId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function newMaintenanceMoteur($moteurIdId, Request $request, EntityManagerInterface $manager): Response
    {
        /** @var object $moteur */
        $moteur = $this->getDoctrine()->getRepository(Moteur::class)
            ->findOneBy(array('id' => $moteurIdId));

        $maintenanceMoteur = new MaintenanceMoteur();
        $form = $this->createForm(MaintenanceMoteurType::class, $maintenanceMoteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var object $moteur */
            $maintenanceMoteur->setMoteurId($moteur);
            $maintenanceMoteur->setCategorieMaintenance('moteur');
            $manager->persist($maintenanceMoteur);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'moteur']);
        }

        return $this->render(
            'maintenance_moteur/new.html.twig',
            [
                'maintenance_moteur' => $maintenanceMoteur,
                'moteurIdentifiant' => $moteurIdId,
                'form' => $form->createView(),
            ]
        );
    }



    /**
     * @Route("/{id}/edit", name="maintenance_moteur_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaintenanceMoteur $maintenanceMoteur
     * @return Response
     */
    public function edit( Request $request, MaintenanceMoteur $maintenanceMoteur): Response
    {
        $form = $this->createForm(MaintenanceMoteurType::class, $maintenanceMoteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home',[
                'id' => $maintenanceMoteur->getId(),
                'rubrique' => 'moteur'
                ]);
        }

        return $this->render(
            'maintenance_moteur/echeanceFormMoteur.html.twig',
            [
                'maintenance_moteur' => $maintenanceMoteur,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="maintenance_moteur_delete", methods={"DELETE"})
     * @param ObjectManager $manager
     * @param MaintenanceMoteur $maintenanceMoteur
     * @return Response
     */
    public function delete(ObjectManager $manager, MaintenanceMoteur $maintenanceMoteur): Response
    {

            $manager->remove($maintenanceMoteur);
            $manager->flush();

        return $this->redirectToRoute('home',['rubrique' => 'moteur']);
    }
    /**
     * @Route("/{moteurId}/parMoteur", name="maintenance_par_moteur")
     * @param $moteurId
     * @param MaintenanceMoteurRepository $repo
     * @return Response
     * @ParamConverter{}
     */
    public function maintenancesDuMoteur($moteurId, MaintenanceMoteurRepository $repo): Response
    {
        $moteur = $this->getDoctrine()->getRepository(Moteur::class)
            ->findOneBy(array('id' => $moteurId));

        $maintenanceMoteur = $repo->findByMoteur($moteur);

        return $this->render(
            'maintenance_moteur/showParMoteur.html.twig',
            [
                'operations' => $maintenanceMoteur,
            ]
        );
    }
}
