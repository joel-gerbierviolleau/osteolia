<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Entity\Patient;
use App\Form\PatientType;

class PatientController extends AbstractController
{
    /**
     * @Route("/all-patients", name="patient/all-patients")
     */
    public function allPatients(Request $request, TranslatorInterface $translator): Response
    {

    	$user = $this->getUser();

        return $this->render('patient/allPatients.html.twig', [
        	'patients' => $user->getPatients(),
        ]);
    }

    /**
     * @Route("/new-patient", name="patient/new-patient")
     */
    public function newPatient(Request $request, TranslatorInterface $translator): Response
    {
    	$user = $this->getUser();
    	$em = $this->getDoctrine()->getManager();
    	$patient = new Patient();
    	$form = $this->createForm(PatientType::class, $patient);

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid())
    	{
    		$patient = $form->getData();
    		$patient->setCreatedBy($user);

    		$em->persist($patient);
    		$em->flush();

    		$this->addFlash('success', $translator->trans('patient.messages.successfully_created'));

    		return $this-> redirectToRoute('patient/patient', [
    			'id' => $patient->getId()
    		]);

    	}

    	return $this->render('patient/newPatient.html.twig', [
    		'form'=> $form->createview(),
    		'patient' => $patient,
    	]);

    }

    /**
     * @Route("/patient-{id<\d+>}", name="patient/patient")
     */
    public function viewPatient(Request $request, Patient $patient, TranslatorInterface $translator): Response
    {
    	if ($this->getUser() !== $patient->getCreatedBy())
    	{
    		throw new AccessDeniedHttpException($translator->trans('patient.messages.unathorized_access'));
    	}

    	return $this->render('patient/patient.html.twig', [
    		'patient' => $patient,
    		'nb_consultations' => 0 //TODO virer ça qd les consultations seront implémentées
    	]);

    }

    /**
     * @Route("/edit-patient-{id<\d+>}", name="patient/edit-patient")
     */
    public function editPatient(Request $request, Patient $patient, TranslatorInterface $translator): Response
    {
    	if ($this->getUser() !== $patient->getCreatedBy())
    	{
    		throw new AccessDeniedHttpException($translator->trans('patient.messages.unathorized_access'));
    	}

    	$em = $this->getDoctrine()->getManager();
    	$form = $this->createForm(PatientType::class, $patient);

    	$form->handleRequest($request);

    	if($form->isSubmitted() && $form->isValid())
    	{
    		$updateDate = new \Datetime();
    		$patient->setLastUpdateDate($updateDate);
    		$patient->setLastUpdatedBy($this->getUser());

    		$em->persist($patient);
    		$em->flush();

    		$this->addFlash('success', $translator->trans('patient.messages.successfully_updated'));

    		return $this->redirectToRoute('patient/patient', [
    			'id' => $patient->getId()
    		]);

    	}

    	return $this->render('patient/editPatient.html.twig', [
    		'form' => $form->createView(),
    		'patient' => $patient
    	]);
    }

    /**
     * @Route("/soft-delete-patient-{id<\d+>}", name="patient/soft-delete-patient")
     */
    public function sotDeletePatient(Request $request, Patient $patient, TranslatorInterface $translator): Response
    {
    	if ($this->getUser() !== $patient->getCreatedBy())
    	{
    		throw new AccessDeniedHttpException($translator->trans('patient.messages.unathorized_access'));
    	}

    	return $this->render('patient/patient.html.twig', [

    	]);
    }



}
