<?php

namespace App\Controller;


use App\Entity\Moteur;
use App\Form\MoteurType;
use Doctrine\Common\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use App\Entity\Bateau;

/**
 * @Route("/moteur")
 */
class MoteurController extends AbstractController
{


    /**
     * @Route("/new/{bateauId}", name="moteur_new", methods={"GET","POST"})
     * @param $bateauId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new($bateauId, Request $request,EntityManagerInterface $manager): Response
    {
        /** @var object $bateau */
        $bateau = $this->getDoctrine()->getRepository(Bateau::class)
                        ->findOneBy(array('id' => $bateauId));

        $moteur = new Moteur();
        $form = $this->createForm(MoteurType::class, $moteur);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {


            $moteur->setBateau(bateau: $bateau);

            $manager->persist($moteur);
            $manager->flush();
            return $this->redirectToRoute('home');
        }

        return $this->render('gestboat/home/moteurs/new.html.twig', [
            'moteur' => $moteur,
            'form' => $form->createView(),
        ]);
    }


    /**
     * @Route("/{id}/edit", name="moteur_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Moteur $moteur
     * @return Response
     */
    public function edit(Request $request, Moteur $moteur): Response
    {
        $form = $this->createForm(MoteurType::class, $moteur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home', [
                'id' => $moteur->getId(),
                'rubrique' => 'moteurs',
                'moteur' => $moteur
            ]);
        }

        return $this->render('gestboat/home/moteurs/edit.html.twig', [
            'moteur' => $moteur,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="moteur_delete", methods={"POST"})
     * @param Request $request
     * @param Moteur $moteur
     * @return Response
     */
    public function delete(Request $request, Moteur $moteur): Response
    {
        if ($this->isCsrfTokenValid('delete'.$moteur->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($moteur);
            $entityManager->flush();
            $this->addFlash(
                                    'success',
                'Le moteur a bien été supprimé!'
                                );
        }

        return $this->redirectToRoute('home');
    }
}
