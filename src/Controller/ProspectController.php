<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Entity\Prospect;
use App\Form\ProspectType;


class ProspectController extends AbstractController
{


    /**
     * @Route("/i-am-interested", name="/i-am-interested")
     */
    public function newProspect(Request $request, TranslatorInterface $translator): Response
    {        

        $prospect = new Prospect();
        $em = $this->getDoctrine()->getManager();

        $form = $this->createForm(ProspectType::class, $prospect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            
            $prospect = $form->getData();
            $em->persist($prospect);
            $em->flush();

            $this->addFlash('notice', $translator->trans('prospect.successfully.saved'));
            if ($prospect->getIsOkToBeContacted() === true)
            {
                $this->addFlash('notice', $translator->trans('prospect.successfully.saved_and_willing_to_help'));
            }

            return $this->redirectToRoute('/see-you-soon');

        } 

        return $this->render('prospect/newProspect.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/see-you-soon", name="/see-you-soon")
     */
    public function seeYouSoon(): Response
    {

        return $this->render('prospect/seeYouSoon.html.twig', []);

    }

    /**
     * @Route("/admin/prospects-list", name="prospect/all")
    */
    public function allProspects(Request $request): Response
    {

        $allProspects = $this->getDoctrine()->getManager()->getRepository(Prospect::class)->findAll();

        return $this->render('prospect/allProspects.html.twig', [
            'prospects' => $allProspects,
        ]);

    }

    /**
     * @Route("/admin/prospect/edit-{id<\d+>}", name="prospect/edit")
    */
    public function editProspect(Request $request, Prospect $prospect, TranslatorInterface $translator): Response
    {

        $form = $this->createForm(ProspectType::class, $prospect);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('notice', $translator->trans('prospect.successfully.edited'));
            return $this->redirectToRoute('prospect/all');
        }

        return $this->render('prospect/editProspect.html.twig', [
            'form' =>$form->createView(),
            'prospect' => $prospect
        ]);

    }

    /**
     *  @Route("/admin/prospects/soft-delete/{id<\d+>}", name="prospect/soft-delete")
    */

    public function softDeleteProspect(Request $request, Prospect $prospect, TranslatorInterface $translator): Response
    {

        $prospect->setSoftDeleted(true);

        $em = $this->getDoctrine()->getManager();
        $em->persis($prospect);
        $em->flush();

        $this->addFlash('notice', $translator->trans('prospect.successfully.soft_deleted'));
        return $this->redirectToRoute('prospect/all');

    }

    /**
     *  @Route("/admin/prospects/hard-delete/{id<\d+>}", name="prospect/hard-delete")
    */

    public function hardDeleteProspect(Request $request, Prospect $prospect, TranslatorInterface $translator): Response
    {

        $em = $this->getDoctrine()->getManager();
        $em->remove($prospect);
        $em->flush();

        $this->addFlash('notice', $translator->trans('prospect.successfully.hard_deleted'));
        return $this->redirectToRoute('prospect/all');

    }


}
