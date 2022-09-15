<?php

namespace App\Form;

use App\Entity\Partners;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AddStructureType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('email', EmailType::class,[
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Email du Partenaire'
        ])
        ->add('plainPassword', PasswordType::class, [
            // instead of being set onto the object directly,
            // this is read and encoded in the controller
            'mapped' => false,
            'attr' => [
                'autocomplete' => 'new-password',
                'class' => 'form-control'
            ],
            'constraints' => [
                new NotBlank([
                    'message' => 'merci de renseigner un mot de passe',
                ]),
                new Length([
                    'min' => 6,
                    'minMessage' => 'Votre mot de passe droit contenir minimum {{ limit }} characteres',
                    // max length allowed by Symfony for security reasons
                    'max' => 4096,
                ]),
            ],
            'label' => 'Mot de Passe'
        ])
        ->add('address', TextType::class, [
            'mapped' => false,
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Adresse'
        ])
        ->add('city', TextType::class, [
            'mapped' => false,
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Ville'
        ])
        ->add('zipCode', TextType::class, [
            'mapped' => false,
            'attr' => [
                'class' => 'form-control'
            ],
            'label' => 'Code postal'
        ])
        ->add('partnerId', EntityType::class, [
            'mapped' => false,
            'class' => Partners::class,
            'choice_label' => 'name'
        ])
        ->add('sellDrinks', CheckboxType::class,[
            'mapped' => false,
            'required' => false,
            'attr' => [
                'id' => 'flexSwitchCheckDefault',
                'class' => 'form-check-input'
            ],
            'label' => 'Vente de boisson'
        ])
        ->add('membersStat', CheckboxType::class,[
            'mapped' => false,
            'required' => false,
            'attr' => [
                'id' => 'flexSwitchCheckDefault',
                'class' => 'form-check-input'
            ],
            'label' => 'Statistiques des membres'
        ])
        ->add('paymentSchedules', CheckboxType::class,[
            'mapped' => false,
            'required' => false,
            'attr' => [
                'id' => 'flexSwitchCheckDefault',
                'class' => 'form-check-input'
            ],
            'label' => 'Calendrier de payment'
        ])
        ->add('employeePlanning', CheckboxType::class,[
            'mapped' => false,
            'required' => false,
            'attr' => [
                'id' => 'flexSwitchCheckDefault',
                'class' => 'form-check-input'
            ],
            'label' => 'Planning des employés'
        ])
        ;
        
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
