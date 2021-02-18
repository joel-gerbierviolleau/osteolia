<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Entity\Patient;
use App\Entity\MedicalHistory;
use App\Form\MedicalHistoryType;

class MedicalHistoryController extends AbstractController
{
    /**
     * @Route("/patient-{id<\d+>}/edit-medical-history", name="patient/edit-medical-history")
     */
    public function editMedicalHistory(Request $request, Patient $patient, TranslatorInterface $translator): Response
    {

    	$user = $this->getUser();

    	if ($user !== $patient->getCreatedBy())
    	{
    		throw new AccessDeniedHttpException($translator->trans('patient.messages.unathorized_access'));
    	}

    	if (!$patient->getMedicalHistory())
    	{
    		$medicalHistory = new MedicalHistory();
    		$medicalHistory->setCreatedBy($user);
    		$medicalHistory->setPatient($patient);
    	} else {
    		$medicalHistory = $patient->getMedicalHistory();
    	}

    	$form = $this->createForm(MedicalHistoryType::class, $medicalHistory);
    	$em = $this->getDoctrine()->getManager();

    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid())
    	{

/*            if ($medicalHistory->getSurgeryHistoryDetails()) {
                $medicalHistory->setHasSurgeryHistory(true);
            } else {
                $medicalHistory->setHasSurgeryHistory(false);
            } */

    		$em->persist($medicalHistory);
    		$em->flush();

    		$this->addFlash('success', $translator->trans('medical_history.messages.successfully_saved'));

    		return $this->redirectToRoute('patient/patient', [
    			'id' => $patient->getId(),
    		]);

    	}

        return $this->render('medical_history/editMedicalHistory.html.twig', [
        	'form' => $form->createView(),
        	'patient' => $patient,
        ]);
    }
}
