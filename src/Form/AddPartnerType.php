<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class AddPartnerType extends AbstractType
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
            ->add('name', TextType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom du Partenaire (ex: Lemon Fitness PARIS)'
            ])
            ->add('picture', FileType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Image en jpg/png',
                'mapped' => false,
                'required' => true,
                'constraints'=> [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                        ],
                        'mimeTypesMessage' => 'Merci de transmettre une image valide'
                ])]
            ])
            ->add('shortDescription', TextareaType::class, [
                'mapped'=> false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Courte description'
            ])
            ->add('longDescription', TextareaType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Description'
            ])
            ->add('url', TextType::class, [
                'mapped' => false,
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Lien du site du partenaire'
            ])
            ->add('active', CheckboxType::class, [
                'attr' => [
                    'id' => 'flexSwitchCheckDefault',
                    'class' => 'form-check-input'
                ],
                'mapped' => false,
                'label' => 'Actif'
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
