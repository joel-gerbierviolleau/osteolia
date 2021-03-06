<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Entity\Patient;
use App\Entity\Consultation;
use App\Form\ConsultationType;


class ConsultationController extends AbstractController
{
    /**
     * @Route("/patient-{id<\d+>}/new-consultation", name="patient/new-consultation")
     */
    public function newConsultation(Request $request, Patient $patient, TranslatorInterface $translator): Response
    {

    	if ($this->getUser() !== $patient->getCreatedBy())
    	{
    		throw new AccessDeniedHttpException($translator->trans('patient.messages.unathorized_access'));
    	}

    	$consultation = new Consultation();
    	$form = $this->createForm(ConsultationType::class, $consultation);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid())
    	{
    		
    		$consultation->setPatient($patient);
    		$consultation->setCreatedBy($this->getUser());
	    	$em = $this->getDoctrine()->getManager();
    		
    		$em->persist($consultation);
    		$em->flush();

    		$this->addFlash('success', $translator->trans('consultation.messages.successfully_created'));

    		return $this->redirectToRoute('patient/patient', [
    			'id' => $patient->getId()
    		]);

    	}

        return $this->render('consultation/newConsultation.html.twig', [
        	'form' => $form->createView(),
        	'patient' => $patient
        ]);

    }

    /**
     * @Route("/edit-consultation-{id<\d+>}", name="consultation/edit-consultation")
     */
    public function editConsultation(Request $request, Consultation $consultation, TranslatorInterface $translator): Response
    {

    	// TO DO : handle practician relacements properly !! this is crap
    	if ($this->getUser() !== $consultation->getCreatedBy())
    	{
    		throw new AccessDeniedHttpException($translator->trans('patient.messages.unathorized_access'));
    	}

    	$form = $this->createForm(ConsultationType::class, $consultation);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid())
    	{

    		$em = $this->getDoctrine()->getMAnager();
    		$consultation->setLastUpdateDate(new \Datetime());
    		$consultation->setLastUpdatedBy($this->getUser());

    		$em->persist($consultation);
    		$em->flush();

    		$this->addFlash('success', $translator->trans('patient.messages.consultation_updated'));

    		return $this->redirectToRoute('patient/patient', [
    			'id' => $consultation->getPatient()->getId()
    		]);

    	}

    	return $this->render('consultation/editConsultation.html.twig', [
    		'form' => $form->createView(),
    		'consultation' => $consultation
    	]);

    }

    /**
     * @Route("/consultation-{id<\d+>}", name="consultation/view-consultation")
     */

    public function viewConsultation(Request $request, Consultation $consultation): Response
    {
    	return $this>render ('consultation/viewConsultation.html.twig', [
    		'consultation' => $consultation,
    	]);
    }

}
