<?php

namespace App\Form;


use App\Entity\Status;
use App\Entity\Season;
use App\Entity\Activity;
use App\Entity\Place;
use App\Entity\Category;
use App\Entity\Recette;
use App\Form\StepType;
use App\Form\IngredientType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Validator\Constraints\Image;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event): void {
            $recette = $event->getData();
            $form = $event->getForm();

            if ($recette && $recette->getPicture() ) {
                $form->add('deleteCb', CheckboxType::class, [
                    'mapped' => false,
                    'label' => 'Check si vous vouliez suprimer image',
                    'required' => false,
                ]);

            }
        });

        $builder
            ->add('titre', TextType::class, [
                'label' => 'Ma recette',
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description rapide'
            ])
            ->add('cooktime', IntegerType::class, [
                'label' => 'Temps de Cuisson (min)'
            ])
            ->add('preparationTime', IntegerType::class, [
                'label' => 'Temps de préparation (min)'
            ])
            ->add('servings', IntegerType::class, [
                'label' => 'Portions'
            ])
            ->add('date', null, [
                'widget' => 'single_text',
                'label' => 'Date de préparation',
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'nameCategory',
                'label' => 'Catégorie',
                'placeholder' => 'Sélectionner une catégorie'
            ])
            ->add('status', EntityType::class, [
                'class' => Status::class,
                'choice_label' => 'nameStatus',
                'label' => 'Statut',
                'placeholder' => 'Choisir un statut'
            ])
            ->add('season', EntityType::class, [
                'class' => Season::class,
                'choice_label' => 'nameSeason',
                'label' => 'Saison',
                'placeholder' => 'Choisir une saison'
            ])
            ->add('activity', EntityType::class, [
                'class' => Activity::class,
                'choice_label' => 'nameActivity',
                'label' => 'Activité',
                'placeholder' => 'Choisir une activité'
            ])
            ->add('public', ChoiceType::class, [
                'label' => 'Public',
                'choices' => [
                    'Adultes' => 'Adultes',
                    'Enfants' => 'Enfants',
                    'Tous' => 'Tous',
                ],
                'placeholder' => 'Choisir un public',
                'required' => false,
            ])
            ->add('place', EntityType::class, [
                'class' => Place::class,
                'choice_label' => 'namePlace',
                'label' => 'Lieu',
                'placeholder' => 'Choisir un lieu'
            ])
            ->add('picture', FileType::class, [
                'label' => 'Photo de la recette (png, jpeg)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '6000K',
                        'mimeTypes' => ['image/png', 'image/jpeg', 'image/webp',],
                        'mimeTypesMessage' => 'Please upload a valid PNG or JPEG file',
                    ])
                ]

            ])
            ->add('difficulty', ChoiceType::class, [
                'label' => 'Niveau de difficulté',
                'choices' => [
                    'Facile' => 'facile',
                    'Moyen' => 'moyen',
                    'Difficile' => 'difficile',
                ],
                'placeholder' => 'Choisir un niveau',
            ])
            ->add('producer', TextType::class, [
                'label' => 'Producteur Local',
            ])
            ->add('ingredients', CollectionType::class, [
                'entry_type' => IngredientType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Ingrédients',
            ])
            ->add('steps', CollectionType::class, [
                'entry_type' => StepType::class,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
                'label' => 'Étapes',
            ]);



    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
            'csrf_protection' => true,
            //linea aqui abajo me dice que esta bien mi classe de formulario asociado a mi entite recette

        ]);
    }
}
