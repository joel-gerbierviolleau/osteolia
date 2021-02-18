<?php

namespace App\Form;

use App\Entity\MedicalHistory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class MedicalHistoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('hasSurgeryHistory', CheckboxType::class, [
                'required' => false,
            ])
/*            ->add('hasSurgeryHistory', CheckboxType::class, [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'yes' => true,
                    'no' => false
                ], 
                'required' => true,
            ]) */
            ->add('surgeryHistoryDetails', TextareaType::class, [
                'required' => false,
            ])
/*            ->add('hasTraumaHistory', ChoiceType::class,  [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'yes' => true,
                    'no' => false
                ],
                'required' => true,
            ]) */
            ->add('hasTraumaHistory', CheckboxType::class, [
                'required' => false
            ])
            ->add('traumaHistoryDetails', TextareaType::class, [
                'required' => false,
            ])
            ->add('hasMedicalTreatmentHistory', CheckboxType::class,  [
                'required' => false,
            ])
/*            ->add('hasMedicalTreatmentHistory', ChoiceType::class,  [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'yes' => true,
                    'no' => false
                ],
                'required' => true,
            ]) */
            ->add('medicalTreatmentHistoryDetails', TextareaType::class, [
                'required' => false,
            ])
            ->add('hasFamilialHistory', CheckboxType::class,  [
                'required' => false,
            ])
/*            ->add('hasFamilialHistory', ChoiceType::class,  [
                'expanded' => true,
                'multiple' => false,
                'choices' => [
                    'yes' => true,
                    'no' => false
                ],
                'required' => true,
            ]). */
            ->add('familialHistoryDetails', TextareaType::class, [
                'required' => false,
            ])
            ->add('regularPhysician', TextType::class, [
                'required' => false
            ])
            ->add('submit', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => MedicalHistory::class,
        ]);
    }
}
