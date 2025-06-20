<?php

namespace App\Twig\Components;

use App\Catalog\Entity\Product;
use App\Catalog\Form\ProductCreateForm;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\Component\HttpKernel\Attribute\AsController;

#[AsLiveComponent]
final class ProductCreateFormComponent extends AbstractController
{
    use DefaultActionTrait;
    use LiveCollectionTrait;


    #[LiveProp]
    public ?Product $product = null;

    public function instantiateForm(): FormInterface
    {
        return $this->createForm(ProductCreateForm::class, $this->product);
    }
}
