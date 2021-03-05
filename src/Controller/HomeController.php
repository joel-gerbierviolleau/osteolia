<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Entity\Prospect;
use App\Form\ProspectType;
use App\Entity\Consultation;


class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, TranslatorInterface $translator): Response
    {        

        $em = $this->getDoctrine()->getManager();

        if ($this->isGranted('IS_AUTHENTICATED_FULLY') && $this->isGranted('ROLE_ADMIN') === false) 
        {
           return $this->userHomePage($request, $translator);
        }

        if ($this->isGranted('ROLE_ADMIN'))
        {
           return $this->adminHomePage($request, $translator);
        }

    	$prospect = new Prospect();
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

    		return $this->redirectToRoute('see_you_soon');

    	} 

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'prospect' => $prospect,
        ]);

    }

    /**
     * @Route("/privacy", name="privacy")
     */
    public function privacy(Request $request): Response
    {

        return $this->render('privacy.html.twig');

    }

    /**
     * @Route("/about", name="about")
     */
    public function about(Request $request): Response
    {

        return $this->render('about.html.twig');

    }

    private function userHomePage(Request $request, TranslatorInterface $translator): Response
    {

            $em = $this->getDoctrine()->getManager();
            $consultations = $em->getRepository(Consultation::class)->findAll();

            return $this->render('home/homeUser.html.twig', [
                'consultations' => $consultations,
            ]);

    }

    private function adminHomePage(Request $request, TranslatorInterface $translator): Response
    {

            $em = $this->getDoctrine()->getManager();
            $allProspects = $em->getRepository(Prospect::class)->findAll();

            return $this->render('home/homeAdmin.html.twig', [
                'allProspects' => $allProspects
            ]);

    }


}
