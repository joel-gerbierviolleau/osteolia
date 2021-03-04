<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;
use App\Entity\Prospect;
use App\Form\ProspectType;

use Symfony\Component\Mailer\MailerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mime\Address;



class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(Request $request, TranslatorInterface $translator): Response
    {        

    	$prospect = new Prospect();
        $em = $this->getDoctrine()->getManager();

        $allProspects = $em->getRepository(Prospect::class)->findAll();

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

        return $this->render('index.html.twig', [
            'form' => $form->createView(),
            'prospect' => $prospect,
            'allProspects' => $allProspects,
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

    /*
     * @Route("/test-mailer", name="test_mailer")
     *
    public function testMailer(Request $request, MailerInterface $mailer, TranslatorInterface $translator): Response
    {

        $user = $this->getUser();

//        try {
            $email = (new TemplatedEmail())
                ->from(new Address('security@osteolia.com', 'Osteolia'))
                ->to('joel.gerbierviolleau@gmail.com')
                ->subject('test mailer')
                ->htmlTemplate('test_template.html.twig')
                ->context([
                    'user' => $user,
                ])
            ;

            $mailer->send($email);
            $this->addFlash('success', 'mail sent !');

//        } catch (\Exception $e) {
//            $this->addFlash('error', $e->getMessage() );
//        };

        return $this->redirectToRoute('home');

    }
 */

}
