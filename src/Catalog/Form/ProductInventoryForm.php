<?php

namespace App\Catalog\Form;

use App\Catalog\Entity\Inventory;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;

class ProductInventoryForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('quantityAvailable', NumberType::class, [
                'label' => 'Quantité',
                'attr' => ['placeholder' => 'Entrez la quantité'],
                'constraints' => [
                    new NotBlank(),
                    new GreaterThanOrEqual([
                        'value' => 0,
                    ]),

                ],
            ])
            ->add('lowStockThreshold', NumberType::class, [
                'label' => 'Seuil de stock',
                'attr' => ['placeholder' => 'Entrez le seuil de stock'],
                'constraints' => [
                    new NotBlank(),
                    new GreaterThanOrEqual([
                        'value' => 0,
                    ]),
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inventory::class,
        ]);
    }
}
