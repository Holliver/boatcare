<?php
/**
 * Created by PhpStorm.
 * User: olivierbaviere
 * Date: 2019-01-31
 * Time: 19:18
 */

namespace App\Controller;


use App\Entity\Bateau;
use App\Form\BateauType;
use App\Repository\BateauRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class GestboatController extends AbstractController
{
    /**
     * @Route("/", name="home")
     * @param BateauRepository $repo
     * @return Response
     * @throws NonUniqueResultException
     */
    public function bateauDuUser(BateauRepository $repo): Response
    {
        $user = $this->getUser();

        $bateau = $repo->userBateau($user);

        return $this->render(
            'gestboat/home1.html.twig',
            [
                'bateau' => $bateau,
            ]
        );

    }

    /**
     * Créer un bateau
     *
     * @param $userId
     * @param Request $request
     * @param EntityManagerInterface $manager
     * @param UserRepository $userRepository
     * @return Response
     * @Route("/bateau/new/{userId}", name="new_bateau")
     */
    public function formNewEditBateau(
        $userId,
        Request $request,
        EntityManagerInterface $manager,
        UserRepository $userRepository
    ): Response
    {
        $user = $userRepository->findOneById([$userId,]);
        $bateau = new Bateau();
        $form = $this->createForm(BateauType::class,$bateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $bateau->setUserId($user);
            $manager->persist($bateau);
            $manager->flush();

            return $this->redirectToRoute(
                'home',
                ['id' => $bateau->getId()]
            );
        }

        return $this->render(
            'bateau/newBateau.html.twig',
            ['formBateau' => $form->createView()]

        );
    }

    /**
     * Formulaire de modification d'un bateau
     * @Route("/bateau/{id}/edit", name="bateau_edit", methods={"GET","POST"})
     * @param Request $request
     * @param Bateau $bateau
     * @return Response
     */
    public function edit(Request $request,Bateau $bateau): Response
    {
        $form = $this->createForm(BateauType::class,$bateau);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home',['id' => $bateau->getId()]);
        }

        return $this->render(
            'bateau/bateauEdit.html.twig',
            [
                'bateau' => $bateau,
                'form' => $form->createView(),
            ]
        );
    }

    /**
     * @Route("bateauDelete/{id}", name="bateau_delete", methods={"DELETE"})
     * @param Request $request
     * @param Bateau $bateau
     * @return Response
     */
    public function delete(Request $request,Bateau $bateau): Response
    {
        if ($this->isCsrfTokenValid('delete' . $bateau->getId(),$request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($bateau);
            $entityManager->flush();
        }

        return $this->redirectToRoute('bateau_edit');
    }

    /**
     * @Route("phpinfo", name="pfpinfo", methods={"GET","POST"})
     */
    public function phpinfo(): Response
    {
        ob_start();
        phpinfo();
        $phpinfo = ob_get_clean();

        return $this->render(view: 'phpinfo.html.twig',parameters: array(
            'phpinfo' => $phpinfo,
        ));
    }
}