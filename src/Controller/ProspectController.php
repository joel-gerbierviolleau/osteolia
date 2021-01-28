<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Prospect;
use App\Form\ProspectType;

class ProspectController extends AbstractController
{

    public function newProspect(Request $request): Response
    {

    	$prospect = new Prospect();
        $em = $this->getDoctrine()->getManager();

    	$form = $this->createForm(ProspectType::class, $prospect);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid())
    	{
            
            $this->addFlash('notice', 'Great, form seems to be valid');

/*    		$prospect = $form->getData();
    		$em->persist($prospect);
    		$em->flush(); */

    		return $this->redirectToRoute('/new-prospect'); 

    	}

        return $this->render('prospect/prospect.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
