<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Contracts\Translation\TranslatorInterface;

class ChangePasswordFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
//        $translator = new TranslatorInterface();
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'type' => PasswordType::class,
                'first_options' => [
                    'constraints' => [
                        new NotBlank([
                            'message' => 'reset_password.empty_fields',
                        ]),
                        new Length([
                            'min' => 6,
                            'minMessage' => 'reset_password.length_constrait', //  {{ limit }}
                            // max length allowed by Symfony for security reasons
                            'max' => 4096,
                        ]),
                    ],
                    'label' => 'type password please', //reset_password.password_placeholder',
                    'attr' => [
                        'placeholder' => 'reset_password.password_placeholder'
                    ],
                ],
                'second_options' => [
                   'label' => 'go again', //Repeat Password',
                    'attr' => [
                        'placeholder' => 'reset_password.repeat_password_placeholder'
                    ],
                ],
                'invalid_message' => 'reset_password.passwords_must_match',
                // Instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([]);
    }
}
