<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;

class UserController extends AbstractController
{
    /**
     * @Route("/user/index", name="user_index")
     */
    public function index(): Response
    {
        $users = $this->getDoctrine()->getRepository(User::class)->findAll();
return $this->render(
            'user/index.html.twig',
            array('users' => $users)
        );

    }
    /**
     * @Route("/edit/user/{id}", name="edit_user")
     * @paramConverter("user", class="App\Entity\User")
     * @param User $user
     */

    public function editUser (User $user, Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted()&& $form->isValid()){
            $em->persist($user);
            $em->flush();
        }
        return $this->render ("user/Edit.html.twig", ['user' => $user, 'form' => $form->createView()]);
    
    }

}
