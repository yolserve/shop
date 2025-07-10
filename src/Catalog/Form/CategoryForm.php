<?php

namespace App\Catalog\Form;

use App\Catalog\Entity\Category;
use App\Catalog\Enum\CategoryStatus;
use Ehyiah\QuillJsBundle\Form\QuillType;
use Symfony\Component\Form\AbstractType;
use Symfony\UX\Dropzone\Form\DropzoneType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la catégorie',
                'attr' => ['placeholder' => 'Entrez le nom de la catégorie'],
            ])
            ->add('description', QuillType::class, [
                'quill_extra_options' => [
                    'height' => '180px',
                    'theme' => 'snow',
                    'placeholder' => 'Description de la catégorie',
                ],
            ])
            ->add('status', EnumType::class, [
                'class' => CategoryStatus::class,
                'label' => 'Statut de la catégorie',
            ])
            ->add('thumbnailFile', VichImageType::class, [
                'required' => false,
                'label' => 'Vignette de la catégorie',

            ])
            ->add('metaTitle', TextType::class, [
                'label' => 'Titre méta',
                'attr' => ['placeholder' => 'Entrez le titre méta'],
            ])
            ->add('metaDescription', TextType::class, [
                'label' => 'Description méta',
                'attr' => ['placeholder' => 'Entrez la description méta'],
            ])
            ->add('parentCategory', EntityType::class, [
                'class' => Category::class,
                'label' => 'Catégorie Parent',
                'choice_label' => 'name',
                'placeholder' => 'Selectionnez la catégorie parent',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
