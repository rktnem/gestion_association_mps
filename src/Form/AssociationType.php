<?php

namespace App\Form;

use App\Entity\Besoin;
use App\Entity\Commune;
use App\Entity\District;
use App\Entity\Association;
use Doctrine\ORM\QueryBuilder;
use App\Entity\TypeAssociation;
use App\Repository\CommuneRepository;
use Symfony\Component\Form\FormEvents;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\Regex;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Sequentially;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class AssociationType extends AbstractType
{
    private EntityManagerInterface $em;

    public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', TextType::class, [
                'label' => 'Nom de l\'association',
                'constraints' => new NotBlank(
                    message: "Cette champ n'accepte pas les espaces."
                ),
                'attr' => [
                    'placeholder' => 'Nom de l\'association...'
                ]
            ])
            ->add('membre', NumberType::class, [
                'html5' => true,
                'label' => 'Nombre de membre',
                'constraints' => new NotBlank(
                    message: "Cette champ ne valide pas les espaces comme donnée."
                ),
                'attr' => [
                    'placeholder' => "Nombre de persone dans l'association..." 
                ]
            ])
            ->add('nom_president', TextType::class, [
                'label' => 'Nom du président(e)',
                'required' => false,
                'empty_data' => '',
                'constraints' => new Regex(
                    '/^[A-Za-zéèàôçùï ]+$/', 
                    message: "Le nom ne doit pas comporter des nombres ou de caractère spéciaux non courant."
                ),
                'attr' => [
                    'placeholder' => 'Nom du président(e)...'
                ]
            ])
            ->add('nif_stat', CheckboxType::class, [
                'label' => "NIF / STAT (Oui ou Non)",
                'required' => false
            ])
            ->add('numero_recepisse', TextType::class, [
                'label' => 'Numéro du recépissé',
                'required' => false,
                'empty_data' => '',
                'attr' => [
                    'placeholder' => 'Numéro du recépissé...'
                ]
            ])
            ->add('contact', TextType::class, [
                'constraints' => new Regex(
                    '/^[0-9]+$/', 
                    message: "Le contact donné n'est pas valide."
                ),
                'attr' => [
                    'placeholder' => 'Contact...'
                ]
            ])
            ->add('district', EntityType::class, [
                'class' => District::class,
                'choice_label' => 'nom',
                'mapped' => false
            ])
            ->add('commune', EntityType::class, [
                'class' => Commune::class,
                'query_builder' => function (CommuneRepository $repository) {
                    return $this->orderCommuneList($repository);
                },
                'choice_label' => 'nom',
            ])
            ->add('type_association', EntityType::class, [
                'class' => TypeAssociation::class,
                'choice_label' => 'type',
            ])
            // ->add('save', SubmitType::class, [
            //     'label' => "Créer"
            // ])
            // ->add('edit', SubmitType::class, [
            //     'label' => "Modifier"
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Association::class,
        ]);
    }

    private function orderCommuneList(
        CommuneRepository $repository
    ): QueryBuilder {
        return $repository->createQueryBuilder('c')
                ->orderBy('c.nom', 'ASC')
        ;
    }
}