<?php

namespace App\Controller;

use App\Entity\Administration;
use App\Entity\Bateau;
use App\Form\AdministrationType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/administration")
 */
class AdministrationController extends AbstractController
{

    /**
     * @Route("/new/{bateauId}", name="administration_new", methods={"GET","POST"})
     * @param Bateau $bateauId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new(Bateau $bateauId, Request $request, EntityManagerInterface $manager): Response
    {
        $bateau = $this->getDoctrine()->getRepository(Bateau::class)
                               ->findOneBy(array('id' => $bateauId));
        $administration = new Administration();
        $form = $this->createForm(AdministrationType::class, $administration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $administration->setBateau($bateau)->getBateau();

            $manager->persist($administration);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'administration']);
        }

        return $this->render('gestboat/home/administration/new.html.twig', [
            'administration' => $administration,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="administration_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Administration $administration
     * @return Response
     */
    public function edit(Request $request,Administration $administration): Response
    {

        $form = $this->createForm(AdministrationType::class, $administration);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home',['rubrique' => 'administration']);
        }

        return $this->render('gestboat/home/administration/edit.html.twig', [
            'administration' => $administration,
            'id' => $administration->getId(),
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="administration_delete", methods={"DELETE"})
     * @param Request $request
     * @param Administration $administration
     * @return Response
     */
    public function delete(Request $request, Administration $administration): Response
    {
        if ($this->isCsrfTokenValid('delete'.$administration->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($administration);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home',['rubrique' => 'administration']);
    }
}
