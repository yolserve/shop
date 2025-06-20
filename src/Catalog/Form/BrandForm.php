<?php

namespace App\Catalog\Form;

use Dom\Text;
use App\Catalog\Entity\Brand;
use App\Catalog\Entity\Category;
use App\Catalog\Enum\BrandStatus;
use App\Catalog\Enum\CategoryStatus;
use Ehyiah\QuillJsBundle\Form\QuillType;
use Symfony\Component\Form\AbstractType;
use Symfony\UX\Dropzone\Form\DropzoneType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class BrandForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Nom de la marque',
                'attr' => ['placeholder' => 'Entrez le nom de la marque'],
            ])
            ->add('description', QuillType::class, [
                'quill_extra_options' => [
                    'height' => '180px',
                    'theme' => 'snow',
                    'placeholder' => 'Description de la catégorie',
                ],
            ])
            ->add('status', EnumType::class, [
                'class' => BrandStatus::class,
                'label' => 'Statut de la marque',
            ])
            ->add('logoFile', DropzoneType::class, [
                'mapped' => false,
                'label' => 'Logo de la marque',

            ])
            ->add('metaTitle', TextType::class, [
                'label' => 'Titre méta',
                'attr' => ['placeholder' => 'Entrez le titre méta'],
            ])
            ->add('metaDescription', TextType::class, [
                'label' => 'Description méta',
                'attr' => ['placeholder' => 'Entrez la description méta'],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Brand::class,
        ]);
    }
}
