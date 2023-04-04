<?php

namespace App\Controller;

use App\Entity\Bateau;
use App\Entity\Electronique;
use App\Form\ElectroniqueType;
use Doctrine\ORM\EntityManagerInterface;
use phpDocumentor\Reflection\Types\Object_;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/electronique")
 */
class ElectroniqueController extends AbstractController
{

    /**
     * @Route("/new/{id}", name="electronique_new", methods={"GET","POST"})
     * @param $bateau $bateau
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new(Bateau $bateau, Request $request, EntityManagerInterface $manager): Response
    {
        $electronique = new Electronique();
        $form = $this->createForm(ElectroniqueType::class, $electronique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $electronique->setBateau($bateau)->getBateau();
            $manager->persist($electronique);
            $manager->flush();
            return $this->redirectToRoute('home',['rubrique' => 'electronique']);
        }

        return $this->render('gestboat/home/electronique/new.html.twig', [
            'electronique' => $electronique,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="electronique_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Electronique $electronique
     * @return Response
     */
    public function edit(Request $request, Electronique $electronique, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(ElectroniqueType::class, $electronique);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            return $this->redirectToRoute('home',['rubrique' => 'electronique']);
        }

        return $this->render('gestboat/home/electronique/edit.html.twig', [
            'electronique' => $electronique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="electronique_delete", methods={"POST"})
     * @param Request $request
     * @param Electronique $electronique
     * @return Response
     */
    public function delete(Request $request, Electronique $electronique, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$electronique->getId(), $request->request->get('_token'))) {
            $manager->remove($electronique);
            $manager->flush();
            $this->addFlash('success', 'L\'appareil électronique a été supprimé avec succès !');
        }

        return $this->redirectToRoute('home',['rubrique' => 'electronique']);
    }
}
