<?php

namespace App\Catalog\Form;

use App\Catalog\Entity\ProductVariant;
use App\Catalog\Entity\VariantAttribute;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class VariantAttributeForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez le nom de l\'attribut'],
                'constraints' => [
                    new NotBlank(),

                ],
            ])
            ->add('value', TextType::class, [
                'label' => false,
                'attr' => ['placeholder' => 'Entrez la valeur de l\'attribut'],
                'constraints' => [
                    new NotBlank(),
                ],
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => VariantAttribute::class,
        ]);
    }
}
