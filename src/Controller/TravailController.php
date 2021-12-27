<?php

namespace App\Controller;

use App\Entity\Travail;
use App\Form\TravailType;
use App\Repository\TravailRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/travail")
 */
class TravailController extends AbstractController
{
    /**
     * @Route("/", name="travail_index", methods={"GET"})
     */
    public function index(TravailRepository $travailRepository): Response
    {
        return $this->render('travail/index.html.twig', [
            'travails' => $travailRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="travail_new", methods={"GET", "POST"})
     */
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $travail = new Travail();
        $form = $this->createForm(TravailType::class, $travail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($travail);
            $entityManager->flush();

            return $this->redirectToRoute('travail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('travail/new.html.twig', [
            'travail' => $travail,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="travail_show", methods={"GET"})
     */
    public function show(Travail $travail): Response
    {
        return $this->render('travail/show.html.twig', [
            'travail' => $travail,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="travail_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Travail $travail, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(TravailType::class, $travail);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('travail_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('travail/edit.html.twig', [
            'travail' => $travail,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="travail_delete", methods={"POST"})
     */
    public function delete(Request $request, Travail $travail, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$travail->getId(), $request->request->get('_token'))) {
            $entityManager->remove($travail);
            $entityManager->flush();
        }

        return $this->redirectToRoute('travail_index', [], Response::HTTP_SEE_OTHER);
    }

    /**
     * @Route("/voirlistedepot/{id}", name="voirlistedepot", methods={"GET"})
     */

    public function voirlistedepot($id)
    {

        $travail= $this->getDoctrine()->getRepository(Travail::class)->findOneBy(array('id' => $id));
        return $this->render('depot/Voir-liste-Depot.html.twig',[
            'travail' => $travail,
        ]);
   
    }


    



}



