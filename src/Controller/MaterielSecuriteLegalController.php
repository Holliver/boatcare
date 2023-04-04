<?php

namespace App\Controller;

use App\Entity\MaterielSecuriteLegal;
use App\Form\MaterielSecuriteLegalType;
use App\Repository\MaterielSecuriteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/materiel/securite/legal")
 */
class MaterielSecuriteLegalController extends AbstractController
{
    /**
     * @Route("/", name="materiel_securite_legal_index", methods={"GET"})
     * @param MaterielSecuriteRepository $materielSecuriteRepository
     * @return Response
     */
    public function index(MaterielSecuriteRepository $materielSecuriteRepository): Response
    {
        return $this->render('materiel_securite_legal/index.html.twig',[
            'materiel_securite_legals' => $materielSecuriteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="materiel_securite_legal_new", methods={"GET","POST"})
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $materielSecuriteLegal = new MaterielSecuriteLegal();
        $form = $this->createForm(MaterielSecuriteLegalType::class,$materielSecuriteLegal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($materielSecuriteLegal);
            $entityManager->flush();

            return $this->redirectToRoute('materiel_securite_legal_index');
        }

        return $this->render('materiel_securite_legal/new.html.twig',[
            'materiel_securite_legal' => $materielSecuriteLegal,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="materiel_securite_legal_edit", methods={"GET","POST"})
     * @param Request $request
     * @param MaterielSecuriteLegal $materielSecuriteLegal
     * @return Response
     */
    public function edit(Request $request,MaterielSecuriteLegal $materielSecuriteLegal): Response
    {
        $form = $this->createForm(MaterielSecuriteLegalType::class,$materielSecuriteLegal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materiel_securite_legal_index');
        }

        return $this->render('materiel_securite_legal/edit.html.twig',[
            'materiel_securite_legal' => $materielSecuriteLegal,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="materiel_securite_legal_delete", methods={"DELETE"})
     * @param Request $request
     * @param MaterielSecuriteLegal $materielSecuriteLegal
     * @return Response
     */
    public function delete(Request $request,MaterielSecuriteLegal $materielSecuriteLegal): Response
    {
        if ($this->isCsrfTokenValid('delete' . $materielSecuriteLegal->getId(),$request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($materielSecuriteLegal);
            $entityManager->flush();
        }

        return $this->redirectToRoute('materiel_securite_legal_index');
    }



}
