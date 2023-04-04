<?php

namespace App\Controller;

use App\Entity\Bateau;
use App\Entity\Voile;
use App\Form\VoileType;
use App\Repository\VoileRepository;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/voile")
 */
class VoileController extends AbstractController
{


    /**
     * @Route("/new/{id}", name="voile_new", methods={"GET","POST"})
     * @param Bateau $bateau
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new(Bateau $bateau,Request $request,EntityManagerInterface $manager): Response
    {

        $voile = new Voile();
        $form = $this->createForm(VoileType::class, $voile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $voile->setBateau($bateau)->getBateau();

            $manager->persist($voile);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'voiles']);
        }

        return $this->render(
            'gestboat/home/voile/new.html.twig',
            [
                'voile' => $voile,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="voile_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Voile $voile
     * @return Response
     */
    public function edit(Request $request,Voile $voile, EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(VoileType::class, $voile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $manager->flush();

            return $this->redirectToRoute(
                'home',
                [
                    'voile' => $voile,
                    'id' => $voile->getId(),
                    'rubrique' => 'voiles'
                ]
            );
        }

        return $this->render(
            'gestboat/home/voile/edit.html.twig',
            [
                'voile' => $voile,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}", name="voile_delete", methods={"POST"})
     * @param Request $request
     * @param Voile $voile
     * @return Response
     */
    public function delete(Request $request,Voile $voile,EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $voile->getId(),$request->request->get('_token'))) {

            $manager->remove($voile);
            $manager->flush();
            $this->addFlash('success', 'La voile a été supprimée avec succès !');

        }

        return $this->redirectToRoute('home',['rubrique' => 'voiles']);
    }

    /**
     * @Route("/{bateauId}/parbateau", name="voiles_par_bateau")
     * @param $bateauId
     * @param VoileRepository $repo
     * @return Response
     * @ParamConverter{}
     */
    /* public function voilesDuBateau($bateauId, VoileRepository $repo): Response
     {
         $bateau = $this->getDoctrine()->getRepository(Bateau::class)
             ->findOneBy(array('id' => $bateauId));

         $voilesbateau = $repo->findByBateau($bateau);

         return $this->render(
             'gestboat/homeVoiles.html.twig',
             [
                 'voiles' => $voilesbateau,
             ]
         );
     }
 */

}
