<?php

namespace App\Controller;

use App\Entity\DocEquipementSecurite;
use App\Form\DocEquipementSecuriteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/doc/equipement/securite")
 */
class DocEquipementSecuriteController extends AbstractController
{


    /**
     * @Route("/new", name="doc_equipement_securite_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $docEquipementSecurite = new DocEquipementSecurite();
        $form = $this->createForm(DocEquipementSecuriteType::class, $docEquipementSecurite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($docEquipementSecurite);
            $entityManager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'securite']);
        }

        return $this->render('doc_equipement_securite/new.html.twig', [
            'doc_equipement_securite' => $docEquipementSecurite,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="doc_equipement_securite_edit", methods={"GET","POST"})
     * @param Request $request
     * @param DocEquipementSecurite $docEquipementSecurite
     * @return Response
     */
    public function edit(Request $request, DocEquipementSecurite $docEquipementSecurite): Response
    {
        $form = $this->createForm(DocEquipementSecuriteType::class, $docEquipementSecurite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home',['rubrique' => 'securite']);
        }

        return $this->render('doc_equipement_securite/edit.html.twig', [
            'doc_equipement_securite' => $docEquipementSecurite,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doc_equipement_securite_delete", methods={"DELETE"})
     * @param Request $request
     * @param DocEquipementSecurite $docEquipementSecurite
     * @return Response
     */
    public function delete(Request $request, DocEquipementSecurite $docEquipementSecurite): Response
    {
        if ($this->isCsrfTokenValid('delete'.$docEquipementSecurite->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($docEquipementSecurite);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home',['rubrique' => 'securite']);
    }
}
