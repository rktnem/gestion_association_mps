<?php

namespace App\Form;

use App\Entity\Directions;
use App\Entity\Fonction;
use App\Entity\Services;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('matricule', TextType::class, [
                "attr" => [
                    "readonly" => true
                ]
            ])
            ->add('roles', ChoiceType::class, [
                'choices' => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Directeur' => 'ROLE_DIRECTEUR',
                    'Chef de service' => 'ROLE_CHEF',
                    'Responsable ou autre fonction' => 'ROLE_RESPONSABLE',
                ],
                'multiple' => true,     // permet de choisir plusieurs rôles
                'expanded' => true,     // true = checkboxes, false = <select multiple>
                'label' => 'Rôles',
            ])
            ->add('name', TextType::class, [
                "attr" => [
                    "readonly" => true
                ],
                "label" => "Nom"
            ])
            ->add('firstname', TextType::class, [
                "attr" => [
                    "readonly" => true
                ],
                "label" => "Prénom"
            ])
            ->add('email', TextType::class, [
                "attr" => [
                    "readonly" => true
                ],
                "label" => "Email"
            ])
            ->add('fonction', EntityType::class, [
                'class' => Fonction::class,
                'choice_label' => 'nom',
                "mapped" => false,
                "label" => "Fonction"
            ])
            ->add('services', EntityType::class, [
                'class' => Services::class,
                'choice_label' => 'libelle',
                "mapped" => false,
                "label" => "Service"
            ])
            ->add('directions', EntityType::class, [
                'class' => Directions::class,
                'choice_label' => 'libelle',
                "mapped" => false,
                "label" => "Direction"
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
