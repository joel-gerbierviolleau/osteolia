<?php

namespace App\Form;

use App\Entity\Patient;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class PatientType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('gender', ChoiceType::class, [
                'choices' => [
                    'man' => 1,
                    'woman' => 2,
                    'non-binar' => 3
                ],
                'expanded' => true,
                'multiple' => false,
                'required' => true
            ])
            ->add('firstName', TextType::class, [
                'required' => true,
            ])
            ->add('lastName', TextType::class, [
                'required' => true,
            ])
            ->add('birthDate', DateType::class, [
                'widget' => 'single_text',
            ])
            ->add('addressLine1', TextType::class, [
                'required' => false,
            ])
            ->add('addressLine2', TextType::class, [
                'required' => false,
            ])
            ->add('zipcode', TextType::class, [
                'required' => false,
            ])
            ->add('city', TextType::class, [
                'required' => false,
            ])
            ->add('phoneNumber', TelType::class, [
                'required' => false,
            ])
            ->add('email', EmailType::class, [
                'required' => false,
            ])
            ->add('contactComment', TextareaType::class, [
                'required' => false,
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Patient::class,
        ]);
    }
}
