<?php

namespace App\Controller;

use App\Entity\DocElectronique;
use App\Entity\Electronique;
use App\Form\DocElectroniqueType;
use App\Service\FileUploader;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Exception;



class DocElectroniqueController extends AbstractController
{

    /**
     * @Route("/docElectronique/new/{electronique}", name="doc_electronique_new", methods={"GET","POST"})
     * @param Electronique $electronique
     * @param EntityManagerInterface $manager
     * @param Request $request
     * @param FileUploader $fileUploader
     * @param $docFilename
     * @return Response
     */
    public function new(Electronique $electronique,EntityManagerInterface $manager,Request $request,FileUploader $fileUploader,$docFilename): Response
    {

        $docElectronique = new DocElectronique();
        $form = $this->createForm(DocElectroniqueType::class,$docElectronique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $docElectronique = $form->get('docFilename')->getData();
            if ($docFilename) {
                $docFilename = $fileUploader->upload($docFilename);
                $docElectronique->setDocfilename();
                // $docElectronique->setElectronique($electronique->getId());
                $file = $docElectronique->getDocFilename();

                $fileName = $fileUploader->upload($file);

                /* $file->move(
                     $this->getParameter('upload_directory'),
                     $fileName);*/
                $docElectronique->setDocFilename($fileName);
                $manager->persist($docElectronique);
                $manager->flush();

                return $this->redirectToRoute('home',['rubrique' => 'electronique']);
            }

            return $this->render('doc_electronique/new.html.twig',[
                'doc_electronique' => $docElectronique,
                'form' => $form->createView(),
                'electronique' => $electronique
            ]);
        }
    }


    /**
     * @Route("/{id}/edit", name="doc_electronique_edit", methods={"GET","POST"})
     * @param Request $request
     * @param DocElectronique $docElectronique
     * @return Response
     */
    public function edit(Request $request, DocElectronique $docElectronique): Response
    {
        $form = $this->createForm(DocElectroniqueType::class, $docElectronique);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('home',['rubrique' => 'electronique']);
        }

        return $this->render('doc_electronique/edit.html.twig', [
            'doc_electronique' => $docElectronique,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="doc_electronique_delete", methods={"DELETE"})
     * @param Request $request
     * @param DocElectronique $docElectronique
     * @return Response
     */
    public function delete(Request $request, DocElectronique $docElectronique): Response
    {
        if ($this->isCsrfTokenValid('delete'.$docElectronique->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($docElectronique);
            $entityManager->flush();
        }

        return $this->redirectToRoute('home',['rubrique' => 'electronique']);
    }

    /**
     * @return string
     */
    private function generateUniqueFileName(): string
    {
        // md5() reduces the similarity of the file names generated by
        // uniqid(), which is based on timestamps
        return md5(uniqid('',true));
    }
    }

