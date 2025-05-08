<?php

namespace App\Form;

use App\Entity\Directions;
use App\Entity\Fonction;
use App\Entity\Services;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez soumettre votre matricule',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre matricule doit au moins avoir {{ limit }} caractère',
                        // max length allowed by Symfony for security reasons
                        'max' => 8,
                    ]),
                ],
            ])
            ->add('name', TextType::class, [
                "attr" => [
                    'readonly' => true
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Votre nom est incomplète, soumettez votre matricule',
                    ]),
                ],
            ])
            ->add('firstname', TextType::class, [
                "attr" => [
                    'readonly' => true
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Votre prénom est incomplète, soumettez votre matricule',
                    ]),
                ],
            ])
            ->add('pseudonyme', TextType::class, [
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez donner votre nom d\'appelation',
                    ]),
                ],
            ])
            ->add('email', EmailType::class, [
                "attr" => [
                    'readonly' => true
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Votre email est incomplète, soumettez votre matricule',
                    ]),
                ],
            ])
            ->add('directions', EntityType::class, [
                "class" => Directions::class,
                "choice_label" => "libelle",
            ])
            ->add('services', EntityType::class, [
                "class" => Services::class,
                "choice_label" => "libelle"
            ])
            ->add('fonction', EntityType::class, [
                "class" => Fonction::class,
                "choice_label" => "nom"
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'new-password'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer votre mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'votre mot de passe doit au moins avoir {{ limit }} caractère',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}