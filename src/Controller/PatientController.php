<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Contracts\Translation\TranslatorInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Patient;
use App\Form\PatientType;
use App\Form\SearchPatientByNameType;

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


    public function searchPatientByName(Request $request)
    {

        $form = $this->createForm(SearchPatientByNameType::class, [
                'action' => $this->generateUrl('patient/search-results'),
        ]); 

        return $this->render('patient/searchModule.html.twig', [
            'form' => $form->createView(),
        ]);

    }

    /**
    * @Route("/search-results", name="patient/search-results")
    * @IsGranted("IS_AUTHENTICATED_FULLY")
    */

    public function displayPatientSearchResults(Request $request) : Response
    {
        $form = $this->createForm(SearchPatientByNameType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $this->addFlash('success', 'woohoo');
            $searchedName = $form->getData('search');

            $em = $this->getDoctrine()->getManager();
            $results = $em->getRepository(Patient::class)->findBylastName($searchedName);

        }

        return $this->render('patient/searchResults.html.twig', [
            'patients' => $results,
            'searched_name' => $searchedName['search'],
            'form' => $form->createview()
        ]);

    }


}
