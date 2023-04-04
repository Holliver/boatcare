<?php

namespace App\Controller;


use App\Entity\EquipementSecurite;
use App\Entity\MaterielSecuriteLegal;
use App\Form\EquipementSecuriteNonObligatoireType;
use App\Form\EquipementSecuriteType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/equipement/securite")
 */
class EquipementSecuriteController extends AbstractController
{

    /**
     * @Route("/new/{equipLegalId}", name="equipement_securite_new", methods={"GET","POST"})
     * @param $equipLegalId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function new($equipLegalId,Request $request,EntityManagerInterface $manager): Response
    {
        /** @var object $matLegal */
        $matLegal = (object) $this->getDoctrine()->getRepository(MaterielSecuriteLegal::class)
            ->findOneBy(array('id' => $equipLegalId));

        $equipementSecurite = new EquipementSecurite();
        $form = $this->createForm(EquipementSecuriteType::class,$equipementSecurite);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            if (isset($matLegal)) {
                /** @var object $matLegal */
                $equipementSecurite->setMaterielSecuriteLegal( $matLegal);
            }
            $manager->persist($equipementSecurite);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'securite']);
        }
        return $this->render(
            'equipement_securite/new.html.twig',
            [
                'equipement_securite' => $equipementSecurite,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/newNonObligatoire/{bateauId}", name="equipement_securite_newNonObligatoire", methods={"GET","POST"})
     * @param $bateauId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function newNonObligatoire( $bateauId,Request $request,EntityManagerInterface $manager): Response
    {


        $equipementSecuriteLegal = new EquipementSecurite();
        $form = $this->createForm(EquipementSecuriteNonObligatoireType::class,$equipementSecuriteLegal,['bateau' => $bateauId]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($equipementSecuriteLegal);
            $manager->flush();

            return $this->redirectToRoute('home',['rubrique' => 'securite']);
        }
        return $this->render(
            'equipement_securite/new.html.twig',
            [
                'equipement_securite' => $equipementSecuriteLegal,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("/{id}/edit", name="equipSecu_edit", methods={"GET","POST"})
     * @param Request $request
     * @param EquipementSecurite $equipementSecurite
     * @param EntityManagerInterface $manager
     * @return Response
     */
    public function editMatSec(Request $request, EquipementSecurite $equipementSecurite,EntityManagerInterface $manager): Response
    {
        $form = $this->createForm(EquipementSecuriteType::class,$equipementSecurite);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $manager->flush();
            return $this->redirectToRoute('home',['rubrique' => 'securite']);
        }
        return $this->render('equipement_securite/edit.html.twig',
            [
                'equipement_securite' => $equipementSecurite,
                'form' => $form->createView(),
            ]
        );
    }


    /**
     * @Route("/{id}", name="equipement_securite_delete", methods={"POST"})
     * @param Request $request
     * @param EquipementSecurite $equipementSecurite
     * @return Response
     */
    public function delete(Request $request,EquipementSecurite $equipementSecurite, EntityManagerInterface $manager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $equipementSecurite->getId(),$request->request->get('_token'))) {
            $manager->remove($equipementSecurite);
            $manager->flush();
            $this->addFlash('success', 'L\'équipement de sécurité a été supprimé avec succès !');

        }

        return $this->redirectToRoute('home',['rubrique' => 'securite']);
    }

}
