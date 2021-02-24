<?php

namespace App\Controller\FrontOffice;

use App\Entity\Contact;
use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Form\ContactType;
use App\Notification\ContactNotification;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class PropertyController extends AbstractController
{
    /**
     * @return Response
     * @param PropertyRepository $propertyRepository
     * 
     * @Route("/properties", name="property.index")
     */
    public function index(PropertyRepository $propertyRepository,Request $request, PaginatorInterface $paginator): Response
    {
        $search = new PropertySearch();
        $form = $this->createForm(PropertySearchType::class,$search);

        $form->handleRequest($request);


        $properties = $paginator->paginate(
            $propertyRepository->findAllVisibleQuery($search),
            $request->query->getInt('page',1),
            $this->getParameter('max_properties_per_page')
        );

        return $this->render('front_office/property/index.html.twig',[
            'current_menu_buy'=>'buy',
            'properties' => $properties ,
            'searchForm'=> $form->createView() 
        ]);
    }

    /**
     * @param string $slug
     * @param Property $property
     * @param PropertyRepository $propertyRepository
     * @param Request $request
     * @param TranslatorInterface $translator
     * @param ContactNotification $notification
     * 
     * @return Response
     * 
     * @Route("/properties/{slug}-{id}", name="property.show",requirements={"slug":"[a-z0-9\-]*"})
     */
    public function show(Property $property,string $slug,PropertyRepository $propertyRepository,Request $request,
    TranslatorInterface $translator,ContactNotification $notification): Response
    {
        
        if($property->getSlug() !== $slug ){
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug'=>$property->getSlug()
            ],301);
        }

        $contact = new Contact();
        $contact->setProperty($property);

        $form = $this->createForm(ContactType::class,$contact);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $notification->notify($contact);

            $message = 'Your e-mail has been sent';
            $translator->trans($message);

            $this->addFlash('success',$message);

            /*return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug'=>$property->getSlug()
            ]);*/
        }


        return $this->render('front_office/property/show.html.twig',[
            'current_menu'=>'properties',
            'property'=>$property,
            'contactForm'=>$form->createView()
        ]);
    }
}
