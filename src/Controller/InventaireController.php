<?php

namespace App\Controller;

use App\Repository\BateauRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class InventaireController extends AbstractController
{


    /**
     * @Route ("bateau/inventaire", name="inventaire")
     * @param BateauRepository $repo
     * @return Response
     */
    public function bateauDuUser(BateauRepository $repo): Response
    {
        $user = $this->getUser();

        try {
            /** @var object $bateau */
            $bateau = $repo->userBateau($user);
        } catch (NonUniqueResultException $e) {
        }


        return $this->render(
            'gestboat/inventaire.html.twig',
            [
                'bateau' => $bateau,
            ]
        );

    }
}