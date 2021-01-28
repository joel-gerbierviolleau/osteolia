<?php

namespace App\Form;

use App\Entity\Prospect;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;


class ProspectType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstName',  TextType::class, [
                'attr' => ['aria-label' => 'John', 'placeholder' => 'John'],
                'required' => true,
            ])
            ->add('lastName',  TextType::class, [
                'attr' => ['aria-label' => 'Doe', 'placeholder' => 'Doe'],
                'required' => true,
            ])
            ->add('email',  EmailType::class, [
                'attr' => ['aria-label' => 'john.doe@some.where', 'placeholder' => 'john.doe@some.where'],
                'required' => true,
            ])
            ->add('school',  TextType::class, [
                'attr' => ['aria-label' => 'Collège Osteopatique de Bordeaux', 'placeholder' => 'Collège Osteopatique de Bordeaux'],
                'required' => false,
            ])
            ->add('yearsOfPractice', null, [
                'attr' => ['aria-label' => '2', 'placeholder' => '2'],
                'required' => false,
            ])
            ->add('phoneNumber', TextType::class, [
                'attr' => ['aria-label' => '06 12 34 56 78', 'placeholder' => '06 12 34 56 78'],
                'required' => false,
            ])
            ->add('isOkToBeContacted', CheckboxType::class, [
                'attr' => ['aria-label' => 'no'],
                'required' => false,
            ])
            ->add('submit', SubmitType::class, )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Prospect::class,
        ]);
    }
}
