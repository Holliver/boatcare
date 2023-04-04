<?php
/**
 * Created by PhpStorm.
 * User: olivierbaviere
 * Date: 2019-01-31
 * Time: 19:18
 */

namespace App\Controller;



use App\Repository\BateauRepository;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class GestboatJsonController extends AbstractController
{
    /**
     * @Route("/jsonBoat", name="homeJsonBoat", methods={"GET"})
     * @param BateauRepository $repo
     * @return Response
     * @throws NonUniqueResultException
     */
    public function bateauDuUser(BateauRepository $repo): Response
    {
        $user = $this->getUser();




        return $this->json($repo->userBateau($user), 200, [],['groups' =>'bateau:read'] );
    }


    /**
     * @Route("/jsonBoat", name="homeJsonBoat_store", methods={"POST"})
     * @param Request $request
     * @return void
     */
    public function store(Request $request): void
    {
        $jsonRecu = $request->getContent();

    }
}