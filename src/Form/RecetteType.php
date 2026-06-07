<?php

namespace App\Form;

use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
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

            if ($recette && $recette->getPicture()) {
                $form->add('deleteCb', CheckboxType::class, [
                    'mapped' => false,
                    'label' => 'Check si vous couliez suprimer image',
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
                    'label' => 'Temp de Cuisson'
                ])
                ->add('preparationTime', IntegerType::class, [
                    'label' => 'Temp de Preparation'
                ])
                ->add('servings', IntegerType::class, [
                    'label' => 'portions'
                ])
                ->add('date', null, [
                    'widget' => 'single_text',
                    'label' => 'Date de preparation',
                ])
                ->add('published', CheckboxType::class, [
                    'label' => 'Publier la recette',
                    'required' => false,
                ])
                ->add('picture', FileType::class, [
                    'label' => 'Photo de l\'recette (png,jpeg)',
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
                ]);


    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([

            //linea aqui abajo me dice que esta bien mi classe de formulario asociado a mi entite recette
            'data_class' => Recette::class,
        ]);
    }
}
