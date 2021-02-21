<?php

namespace App\Controller\FrontOffice;

use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class HomeController
 */
class HomeController extends AbstractController
{
    /**
     * @param PropertyRepository $propertyRepository
     * @return Response
     * @Route("/", name="home")
     */
    public function index(PropertyRepository $propertyRepository): Response
    {
        $properties = $propertyRepository->findAllLatest();

        return $this->render('front_office/home.html.twig',compact('properties'));
    }

    /**
     * @return Response
     * @Route("/change-locale/{locale}",name="change_locale")
     */
    public function changeLocale($locale,Request $request):Response
    {
        $request->getSession()->set('_locale',$locale);
        
        return $this->redirect($request->headers->get('referer'));
    }
}
