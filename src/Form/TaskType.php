<?php

namespace App\Form;

use App\Entity\Task;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class TaskType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {


        $builder->add('name', TextType::class, [
            'label' => 'Nom de la tâche',
            'attr' => ['class' => 'nameInput', 'placeholder' => 'Entrer le nom de la tâche']
        ])
            ->add('status', ChoiceType::class, [
                'label' => 'Status de la tâche',
                'choices' => [
                    'Tâche en cours' => "Tâche en cours",
                    'Tâche finis' => "Tâche finis",
                ],
                'attr' => [
                    'class' => 'statusInput', 'placeholder' => 'Entrer le status de la tâche',
                ]
            ])

            ->add('dateOfEnd', DateType::class, [
                'label' => "Date de fin de la tâche",
                'attr' => ['class' => 'dateInput']
            ])
            ->add('Sauvegarder', SubmitType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Task::class,
        ]);
    }
}
