<?php

namespace App\Controller\FrontOffice;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PropertyController extends AbstractController
{
    /**
     * @return Response
     * @param PropertyRepository $propertyRepository
     * 
     * @Route("/properties", name="property.index")
     */
    public function index(PropertyRepository $propertyRepository): Response
    {
        return $this->render('front_office/property/index.html.twig',[
            'current_menu'=>'properties'
        ]);
    }

    /**
     * @param string $slug
     * @param Property $property
     * @param PropertyRepository $propertyRepository
     * 
     * @return Response
     * 
     * @Route("/properties/{slug}-{id}", name="property.show",requirements={"slug":"[a-z0-9\-]*"})
     */
    public function show(Property $property,string $slug,PropertyRepository $propertyRepository): Response
    {
        if($property->getSlug() !== $slug ){
            return $this->redirectToRoute('property.show',[
                'id' => $property->getId(),
                'slug'=>$property->getSlug()
            ],301);
        }

        return $this->render('front_office/property/show.html.twig',[
            'current_menu'=>'properties',
            'property'=>$property
        ]);
    }
}
