<?php

namespace App\Catalog\Form;

use App\Catalog\Entity\Inventory;
use App\Catalog\Enum\VariantStatus;
use App\Catalog\Entity\ProductVariant;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

class ProductVariantForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('price', MoneyType::class, [
                'currency' => 'XAF',
            ])
            ->add('sku', TextType::class, [])
            ->add('variantStatus', EnumType::class, [
                'class' => VariantStatus::class,
                'placeholder' => 'Selectionnez le statut',
            ])
            ->add('variantAttributes', LiveCollectionType::class, [
                'entry_type' => VariantAttributeForm::class,
                'entry_options' => ['label' => false],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => ProductVariant::class,
        ]);
    }
}
