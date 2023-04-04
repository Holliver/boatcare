<?php

namespace App\Controller;

use App\Entity\Bateau;
use App\Entity\Electricite;
use App\Form\ElectriciteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/electricite")
 */
class ElectriciteController extends AbstractController
{

    /**
     * @Route("/new/{id}", name="electricite_new", methods={"GET","POST"})
     * @param Bateau $bateau
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new(Bateau $bateau, Request $request, EntityManagerInterface $manager): Response
    {
        $electricite = new Electricite();
        $form = $this->createForm(ElectriciteType::class, $electricite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $electricite->setBateau($bateau)->getBateau();
            $manager->persist($electricite);
            $manager->flush();
            return $this->redirectToRoute('home',['rubrique' => 'electricite']);
        }

        return $this->render('gestboat/home/electricite/new.html.twig', [
            'electricite' => $electricite,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="electricite_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Electricite $electricite
     * @return Response
     */
    public function edit(Request $request, Electricite $electricite, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ElectriciteType::class, $electricite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('home',
            [
                'id' => $electricite->getId(),
                'rubrique' => 'electricite'

            ]);
        }

        return $this->render('gestboat/home/electricite/edit.html.twig', [
            'electricite' => $electricite,
            'form' => $form->createView(),
        ]);
    }

     /**
     * @Route("/{id}", name="electricite_delete", methods={"POST"})
     * @param Request $request
     * @param Electricite $electricite
     * @return Response
     */
    public function delete(Request $request, Electricite $electricite, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$electricite->getId(), $request->request->get('_token'))) {
            $manager->remove($electricite);
            $manager->flush();
            $this->addFlash('success', 'L\'appareil électrique a été supprimé avec succès !');

        }

        return $this->redirectToRoute('home',['rubrique' => 'electricite']);
    }
}
