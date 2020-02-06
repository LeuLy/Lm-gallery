<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Gallery;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GalleryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',
                    TextType::class,
                    [
                            'label' => 'Nom',
                    ]
            )
            ->add('artist',
                    TextType::class,
                    [
                            'label' => 'Dessinateur',
                    ]
            )
            ->add('imgURL',
                    TextType::class,
                    [
                            'label' => 'URL de l\'image',
                    ]
            )
            ->add('description',
                    TextareaType::class,
                    [
                            'label' => 'Description',
                    ]
            )
//            ->add('user')
            ->add('category',
                        EntityType::class,
                        [
                                'label' => 'Catégorie',
                                'class' => Category::class,
                                'choice_label' => 'catName',
                        ]
                )
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Gallery::class,
        ]);
    }
}
