<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;

class UserController extends AbstractController
{

    /**
     * @Route("/admin/all-users", name="user/all-users")
     */
    public function allUsers(Request $request): Response
    {

    	$em = $this->getDoctrine()->getManager();
    	$users = $em->getRepository(User::class)->findAll();
    	return $this->render('user/allUsers.html.twig', [
    		'users' => $users
    	]);

    }

    /**
     * @Route("/admin/add-user", name="user/add-user")
     */
    public function addUser(Request $request, TranslatorInterface $translator, UserPasswordEncoderInterface $passwordEncoder): Response
    {

    	$user = new User();
    	$em = $this->getDoctrine()->getManager();

    	$form = $this->CreateForm(UserType::class, $user);
    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid())
    	{

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );

    		$user->setIsVerified(true);
    		$em->persist($user);
    		$em->flush();

    		$this->addFlash('success', $translator->trans('user.messages.successfluuy_created', [
    			'%firstName%' => $user->getFirstName(),
    			'%lastName%' => $user->getLastName(),
    		]));

    		return $this->redirectToRoute('user/all-users');

    	}

        return $this->render('user/newUser.html.twig', [
        	'form' => $form->createView(),
        	'user' => $user
        ]);
    }

    /**
     * @Route("/admin/edit-user-{id<\d+>}", name="user/edit-user")
	*/
    public function editUser(Request $request, User $user, TranslatorInterface $translator): Response
    {
    	if ($this->getUser() !== $user)
    	{
			$this->denyAccessUnlessGranted('ROLE_ADMIN');
    	}

    	$em = $this->getDoctrine()->getManager();

    	$form = $this->CreateForm(UserType::class, $user);
    	$form->handleRequest($request);

    	if ($form->isSubmitted() && $form->isValid())
    	{

    		$em->persist($user);
    		$em->flush();

    		$this->addFlash('success', $translator->trans('user.messages.successfluuy_created', [
    			'%firstName%' => $user->getFirstName(),
    			'%lastName%' => $user->getLastName(),
    		]));

    		return $this->redirectToRoute('user/all-users');

    	}

        return $this->render('user/editUser.html.twig', [
        	'form' => $form->createView(),
        	'user' => $user
        ]);
    }

    /**
     * @Route("/admin/user-{id<\d+>}", name="user/user")
     */
    public function viewUser(Request $request, User $user): Response
    {
    	return $this->render('user/user.html.twig',[
            'user' => $user
        ]);
    }

    /**
     * @Route("/my-profile", name="user/my-profile")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
     */
    public function myProfile(Request $request): Response
    {
        return $this->render('user/myProfile.html.twig');
    }

    /**
     * @Route("/edit-my-profile", name="user/edit-my-profile")
     * @IsGranted("IS_AUTHENTICATED_FULLY")
    */
    public function editMyProfile(Request $request, TranslatorInterface $translator): Response
    {

        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager();

        $form = $this->CreateForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {

            $em->persist($user);
            $em->flush();

            $this->addFlash('success', $translator->trans('user.messages.successfully_updated_my_profile'));

            return $this->redirectToRoute('user/my-profile');

        }

        return $this->render('user/editMyProfile.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

}
