<?php

namespace App\Controller\BackOffice;

use App\Entity\Option;
use App\Form\OptionType;
use App\Repository\OptionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/admin/option")
 */
class AdminOptionController extends AbstractController
{
    /**
     * @Route("/", name="admin.option.index", methods={"GET"})
     */
    public function index(OptionRepository $optionRepository): Response
    {
        return $this->render('back_office/option/index.html.twig', [
            'options' => $optionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="admin.option.new", methods={"GET","POST"})
     */
    public function new(Request $request,TranslatorInterface $translator): Response
    {
        $option = new Option();
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($option);
            $entityManager->flush();

            $message = $translator->trans("Option created successfully !");
            
            $this->addFlash("success",$message);

            return $this->redirectToRoute('admin.option.index');
        }

        return $this->render('back_office/option/new.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.option.show", methods={"GET"})
     */
    public function show(Option $option): Response
    {
        return $this->render('back_office/option/show.html.twig', [
            'option' => $option,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="admin.option.edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Option $option,TranslatorInterface $translator): Response
    {
        $form = $this->createForm(OptionType::class, $option);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            $message = $translator->trans("Option updated successfully !");
            
            $this->addFlash("success",$message);

            return $this->redirectToRoute('admin.option.index');
        }

        return $this->render('back_office/option/edit.html.twig', [
            'option' => $option,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="admin.option.delete", methods={"DELETE"})
     */
    public function delete(Request $request, Option $option,TranslatorInterface $translator): Response
    {
        if ($this->isCsrfTokenValid('option_deletion_'.$option->getId(), $request->request->get('csrf_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($option);
            $entityManager->flush();

            $message = $translator->trans("Option deleted successfully !");
            
            $this->addFlash("info",$message);
        }

        return $this->redirectToRoute('admin.option.index');
    }
}
