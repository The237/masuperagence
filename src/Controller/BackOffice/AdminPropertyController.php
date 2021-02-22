<?php

namespace App\Controller\BackOffice;

use App\Entity\Property;
use App\Form\PropertyType;
use App\Repository\PropertyRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\CssSelector\XPath\Translator;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
/**
 * Class HomeController
 */
class AdminPropertyController  extends AbstractController
{
    /**
     * @param PropertyRepository $propertyRepository
     * @return Response
     * @Route("/admin", name="admin.property.index", methods={"GET"})
     */
    public function index(PropertyRepository $propertyRepository): Response
    {
        $properties = $propertyRepository->findAll();

        return $this->render('back_office/property/index.html.twig',compact('properties'));
    }

    /**
     * @param Request $request
     * @param EntityManagerInterface $em
     * 
     * @return Response
     * @Route("/admin/property/create", name="admin.property.create",methods={"GET","POST"})
     */
    public function create(Request $request,EntityManagerInterface $em,TranslatorInterface $translator): Response
    {
        $property = new Property();
        $form = $this->createForm(PropertyType::class,$property);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em->persist($property);
            $em->flush();

            $message = $translator->trans("Property updated successfully !");

            $this->addFlash("success",$message);
            
            return $this->redirectToRoute('admin.property.index');
            
        }

        return $this->render('back_office/property/create.html.twig',[
            'propertyForm'=>$form->createView()
        ]);
    }

    /**
     * @param Property $property
     * @param Request $request
     * @param EntityManagerInterface $em
     * 
     * @return Response
     * @Route("/admin/property/update/{id}", name="admin.property.update",methods={"GET","POST"})
     */
    public function update(Property $property,Request $request,EntityManagerInterface $em,TranslatorInterface $translator): Response
    {
        $form = $this->createForm(PropertyType::class,$property);
        
        $form->handleRequest($request);
        
     

        if($form->isSubmitted() && $form->isValid())
        {    
            $em->flush();   
            $message = $translator->trans("Property updated successfully !");
            
            $this->addFlash("success",$message);

            return $this->redirectToRoute('admin.property.index');
        }

        return $this->render('back_office/property/edit.html.twig',[
            'property'=>$property,
            'propertyForm'=>$form->createView()
        ]);
    }

    /**
     * @Route("/admin/property/delete/{id}",name="admin.property.delete",methods={"DELETE"})
     * 
     * @param Property $property
     * @param Request $request
     * @param EntityManagerInterface $em
     * @param TranslatorInterface $translator
     * 
     * @return Response
     *
     */
    public function delete(Property $property,Request $request,EntityManagerInterface $em,TranslatorInterface $translator): Response
    {
        if($this->isCsrfTokenValid('property_deletion_'.$property->getId(), $request->request->get('csrf_token'))){
            $em->remove($property);
            $em->flush();

            $message = $translator->trans("Property deleted successfully !");
            
            $this->addFlash("info",$message);
        }
        return $this->redirectToRoute('admin.property.index');
    }
   
}
