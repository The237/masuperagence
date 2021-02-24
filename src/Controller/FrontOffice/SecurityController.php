<?php

namespace App\Controller\FrontOffice;


use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Entity\User;
use App\Form\PropertySearchType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Contracts\Translation\TranslatorInterface;

class SecurityController extends AbstractController
{
    /**
     * @return Response
     * @param PropertyRepository $propertyRepository
     * 
     * @Route("/login", name="login")
     */
    public function login(AuthenticationUtils $authenticationUtils,Request $request): Response
    {
        if ($this->getUser()) {
            $this->addFlash('error','Already logged in!');
           return $this->redirectToRoute('home');
        }

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('front_office/security/login.html.twig',[
            'error'=>$error,
            'lastUsername'=>$lastUsername,
            'current_menu'=>'login'
        ]);
    }

     /**
     * @Route("/logout", name="logout",methods="POST|GET")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
