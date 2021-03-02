<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Length;

class UserType extends AbstractType
{

    private $security;

    // let's inject the security service in order to get the current user
    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // allow only admins to edit email
        if ($this->security->isGranted('ROLE_ADMIN'))
        {
            $builder
                ->add('email', EmailType::class, [
                "required" => true
            ]);
        }
        // add password type & filed only upon user creation (e.g id is not set)
        // TO DO : delete it altogether when mailer feature will be completed and user will be able to set up their password in the first place 
        $builder 
            ->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
                $user = $event->getData();
                $form = $event->getForm();
                if (!$user || $user->getId()===null)
                {
                    $form->add('plainPassword', PasswordType::class, [
                        // instead of being set onto the object directly,
                        // this is read and encoded in the controller
                        'mapped' => false,
                        "required" => false,
                        'constraints' => [
                            new NotBlank([
                                'message' => 'Please enter a password',
                            ]),
                            new Length([
                                'min' => 8,
                                'minMessage' => 'Your password should be at least {{ limit }} characters',
                                // max length allowed by Symfony for security reasons
                                'max' => 4096,
                            ]),
                        ]
                    ]);
                }
            });

        $builder
            ->add('firstName', TextType::class, [
                "required" => true
            ])
            ->add('lastName', TextType::class, [
                "required" => true
            ])
            ->add('addressLine1', TextType::class, [
                "required" => false
            ])
            ->add('addressLine2', TextType::class, [
                "required" => false
            ])
            ->add('zipcode', TextType::class, [
                "required" => false
            ])
            ->add('city', TextType::class, [
                "required" => false
            ])
            ->add('phoneNumber', TextType::class, [
                "required" => false
            ])
            ->add('website', TextType::class, [
                "required" => false
            ])
            ->add('submit', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
