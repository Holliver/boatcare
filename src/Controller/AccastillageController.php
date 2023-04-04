<?php

namespace App\Controller;

use App\Entity\Accastillage;
use App\Entity\Bateau;
use App\Form\AccastillageType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/accastillage")
 */
class AccastillageController extends AbstractController
{

    /**
     * @Route("/new/{bateauId}", name="accastillage_new", methods={"GET","POST"})
     * @param $bateauId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new($bateauId,Request $request,EntityManagerInterface $manager): Response
    {
        $bateau = $this->getDoctrine()->getRepository(Bateau::class)
            ->findOneBy(array('id' => $bateauId));
        $accastillage = new Accastillage();
        $form = $this->createForm(AccastillageType::class, $accastillage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $accastillage->setBateau($bateau);

            $manager->persist($accastillage);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'accastillage']);
        }

        return $this->render('gestboat/home/accastillage/new.html.twig', [
            'accastillage' => $accastillage,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="accastillage_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Accastillage $accastillage
     * @return Response
     */
    public function edit(Request $request, Accastillage $accastillage ,EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(AccastillageType::class, $accastillage);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'accastillage']);
        }

        return $this->render('accastillage/edit.html.twig', [
            'accastillage' => $accastillage,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="accastillage_delete", methods={"POST"})
     * @param Request $request
     * @param Accastillage $accastillage
     * @return Response
     */
    public function delete(Request $request, Accastillage $accastillage ,EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$accastillage->getId(), $request->request->get('_token'))) {
            $manager->remove($accastillage);
            $manager->flush();
            $this->addFlash('success', 'Un élément d\'accastillage a été supprimé avec succès !');
        }

        return $this->redirectToRoute('home',['rubrique' => 'accastillage']);
    }
}
