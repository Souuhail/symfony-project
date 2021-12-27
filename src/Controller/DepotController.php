<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Security;
use App\Entity\Depot;
use App\Form\DepotType;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\User;
use App\Entity\Travail;
use App\Form\NoteType;




class DepotController extends AbstractController
{
    /**
     * @Route("/depot", name="depot")
     */
    public function index(): Response
    {
        return $this->render('depot/index.html.twig', [
            'controller_name' => 'DepotController',
        ]);
    }
    /**
     * @Route("/depot/new/{id_user}/{id_travail}", name="depot_new")
     */
    public function addDepot(Request $request, $id_user , $id_travail)
    {
        $Depot = new Depot();
        $form = $this->createForm(DepotType::class, $Depot);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $etudiant= $this->getUser();
            $Depot->setEtudiant($etudiant);
            $travail= $this->getDoctrine()->getRepository(Travail::class)->findOneBy(array('id' => $id_travail));
            $Depot->setTravail($travail);
            $Depot->setLienDeTravail($form['lien_de_travail']->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($Depot);
            $entityManager->flush();
            

            return $this->redirectToRoute('travail_index', [], Response::HTTP_SEE_OTHER);
        }
        

        return $this->renderForm('depot/addDepot.html.twig', [
            'form' => $form,

        ]);

        
        
    }

    

    /**
     * @Route("/NoterDepot/{id}", name="NoterDepot", methods={"GET", "POST"})
     */
    public function NoterDepot(Request $request, $id)
    {
        $depot= $this->getDoctrine()->getRepository(Depot::class)->findOneBy(array('id' => $id));
        $form = $this->createForm(NoteType::class, $depot);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $depot->setNote($form['note']->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($depot);
            $entityManager->flush();
            $id= $depot->getTravail()->getId();
            


            return $this->redirectToRoute('voirlistedepot', array(
                'id' => $id,
        ));
        }
        

        return $this->renderForm('depot/NoterDepot.html.twig', [
            'form' => $form,

        ]);

    }

}

