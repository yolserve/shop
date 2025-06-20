<?php

namespace App\Catalog\Form;

use App\Catalog\Entity\Brand;
use App\Catalog\Entity\Product;
use App\Catalog\Entity\Category;
use App\Catalog\Enum\ProductStatus;
use App\Catalog\Enum\ProductTaxCode;
use Ehyiah\QuillJsBundle\Form\QuillType;
use Symfony\Component\Form\AbstractType;
use Symfony\UX\Dropzone\Form\DropzoneType;
use Symfony\Component\Form\FormBuilderInterface;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class ProductCreateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('sku', TextType::class, [
                'label' => 'Numéro SKU',
                'attr' => ['placeholder' => 'Entrez le SKU du produit'],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('name', TextType::class, [
                'label' => 'Nom du produit',
                'attr' => ['placeholder' => 'Entrez le nom du produit'],
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('description', QuillType::class, [
                'quill_extra_options' => [
                    'height' => '200px',
                    'theme' => 'snow',
                    'placeholder' => 'Decrivez en détail le produit',

                ],
            ])
            ->add('status', EnumType::class, [
                'class' => ProductStatus::class,
                'label' => 'Statut du produit',
                'constraints' => [
                    new NotBlank(),
                ],
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix',
                'currency' => 'XAF',
                'attr' => ['placeholder' => 'Entrez le prix du produit'],

            ])
            ->add('weight', NumberType::class, [
                'label' => 'Poids',
                'attr' => ['placeholder' => 'Entrez le poids du produit'],
            ])
            ->add('dimensions', TextType::class, [
                'label' => 'Dimensions',
                'attr' => ['placeholder' => 'Entrez les dimensions du produit'],
            ])
            ->add('taxCategory', EnumType::class, [
                'label' => 'Catégorie fiscale',
                'class' => ProductTaxCode::class,
                'attr' => ['placeholder' => 'Entrez la catégorie fiscale'],
            ])
            ->add('vatRate', NumberType::class, [
                'label' => 'Taux de TVA',
                'attr' => ['placeholder' => 'Entrez le taux de TVA'],
            ])
            ->add('metaTitle', TextType::class, [
                'label' => 'Titre méta',
                'attr' => ['placeholder' => 'Entrez le titre méta'],
            ])
            ->add('metaDescription', TextType::class, [
                'label' => 'Description méta',
                'attr' => ['placeholder' => 'Entrez la description méta'],
            ])
            ->add('barCode', TextType::class, [
                'label' => 'Code-barres',
                'attr' => ['placeholder' => 'Entrez le code-barres du produit'],
            ])
            ->add('inventory', ProductInventoryForm::class, [])
            ->add('thumbnailFile', DropzoneType::class, [
                'mapped' => false,
                'label' => 'Vignette du produit',
                'attr' => ['placeholder' => 'Glissez-déposez ou sélectionnez une image'],
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
            ])
            ->add('brand', EntityType::class, [
                'mapped' => false,
                'class' => Brand::class,
                'choice_label' => 'name',
            ])
            ->add('physicalProduct', CheckboxType::class, [
                'label' => 'Produit physique',
                'required' => false,
            ])
            ->add('hasVariants', CheckboxType::class, [
                'label' => 'Le produit a des variants',
                'required' => false,
            ])
            ->add('productVariants', LiveCollectionType::class, [
                'entry_type' => ProductVariantForm::class,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
