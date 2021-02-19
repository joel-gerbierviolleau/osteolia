<?php

namespace App\Form;

use App\Entity\Consultation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ConsultationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('anamnesia', TextareaType::class, [
                'required' => true
            ])
            ->add('procedures', TextareaType::class, [
                'required' => false
            ])
            ->add('toDo', TextareaType::class, [
                'required' => false
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Consultation::class,
        ]);
    }
}
