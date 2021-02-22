<?php

namespace App\Controller\FrontOffice;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
            'current_menu'=>'properties',
            'properties' => $properties ,
            'searchForm'=> $form->createView() 
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
