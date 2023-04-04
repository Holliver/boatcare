<?php

namespace App\Controller;

use App\Entity\Outillage;
use App\Form\OutillageType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Bateau;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * @Route("/outillage")
 */
class OutillageController extends AbstractController
{
    /**
     * @param Bateau $bateau
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     * @Route ("/new/{id}", name="outillage_new", methods={"GET","POST"})
     */
    public function new(Bateau $bateau,Request $request,EntityManagerInterface $manager): Response
    {
        $outillage = new Outillage();
        $form = $this->createForm(OutillageType::class, $outillage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $outillage->setBateau($bateau)->getBateau();

            $manager->persist($outillage);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'outillage']);
        }

        return $this->render('gestboat/home/outillage/new.html.twig', [
            'outillage' => $outillage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/edit", name="outillage_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Outillage $outillage
     * @return Response
     */
    public function edit(Request $request, Outillage $outillage, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(OutillageType::class, $outillage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('home',
                [
                    'id' => $outillage->getId(),
                    'rubrique' => 'outillage'

                ]);
        }

        return $this->render('gestboat/home/outillage/edit.html.twig', [
            'outillage' => $outillage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="outillage_delete", methods={"POST"})
     * @param Request $request
     * @param Outillage $outillage
     * @return Response
     */
    public function delete(Request $request, Outillage $outillage, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$outillage->getId(), $request->request->get('_token'))) {
            $manager->remove($outillage);
            $manager->flush();
            $this->addFlash('success', 'L\'appareil électrique a été supprimé avec succès !');

        }

        return $this->redirectToRoute('home',['rubrique' => 'outillage']);
    }

}