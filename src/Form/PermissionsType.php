<?php

namespace App\Form;

use App\Entity\Permissions;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PermissionsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sellDrinks', CheckboxType::class)
            ->add('membersStatistiques', CheckboxType::class)
            ->add('paymentSchedules', CheckboxType::class)
            ->add('employeePlanning', CheckboxType::class)
            // ->add('installId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Permissions::class,
        ]);
    }
}
