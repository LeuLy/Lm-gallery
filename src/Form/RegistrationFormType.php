<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
                ->add(
                        'username',
                        TextType::class,
                        [
                                'label' => 'Identifiant',
                        ]
                )
                ->add('email',
                        TextType::class,
                        [
                                'label' => 'Email'
                        ])
                ->add(
                        'plainPassword',
                        PasswordType::class,
                        [
                                'label' => 'Mot de passe',
                            // instead of being set onto the object directly,
                            // this is read and encoded in the controller
                                'mapped' => false,
                                'constraints' => [
                                        new NotBlank(
                                                [
                                                        'message' => 'Veuillez entrer un mot de passe',
                                                ]
                                        ),
                                        new Length(
                                                [
                                                        'min' => 6,
                                                        'minMessage' => 'Your password should be at least {{ limit }} characters',
                                                    // max length allowed by Symfony for security reasons
                                                        'max' => 4096,
                                                ]
                                        ),
                                ],
                        ]
                )
                ->add(
                        'agreeTerms',
                        CheckboxType::class,
                        [
                                'label' => 'Conditions d\'utilisation',
                                'mapped' => false,
                                'constraints' => [
                                        new IsTrue(
                                                [
                                                        'message' => 'Vous devez acceptez les Conditions d\'utilisation',
                                                ]
                                        ),
                                ],
                        ]
                );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
                [
                        'data_class' => User::class,
                ]
        );
    }
}
