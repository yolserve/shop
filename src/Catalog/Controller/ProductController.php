<?php

declare(strict_types=1);

namespace App\Catalog\Controller;

use App\Catalog\Entity\Category;
use App\Catalog\Entity\Product;
use App\Catalog\Form\ProductCreateForm;
use App\Catalog\Repository\CategoryRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Common\Service\FileUploaderHelper;
use App\Catalog\Repository\ProductRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route(path: "/produits")]
class ProductController extends AbstractController
{
    public function __construct(private readonly FileUploaderHelper $fileUploader) {}
    #[Route(path: "/", name: "product_list", methods: ["GET"])]
    public function index(ProductRepository $repository): Response
    {
        return $this->render("pages/catalog/product/index.html.twig", [
            "products" => $repository->findAll(),
        ]);
    }

    #[Route(path: "/creer-un-produit", name: 'app_product_create')]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product();
        $form = $this->createForm(ProductCreateForm::class, $product);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // $product->setThumbnail($this->fileUploader->uploadProductThumbnail($form->get('thumbnailFile')->getData()));
            // $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product_list');
        }
        return $this->render("pages/catalog/product/create.html.twig", [
            "product" => $product,
            "form" => $form
        ]);
    }

    #[Route(path: "/catalogue-des-produits", name: 'app_product_catalog')]
    public function productCatalog(ProductRepository $repository, CategoryRepository $categoryRepository): Response
    {
        return $this->render("pages/catalog/product/front_product_list.html.twig", [
            "products" => $repository->findAll(),
            "categories" => $categoryRepository->findBy(['parentCategory' => null], ['name' => 'ASC']),
        ]);
    }

    #[Route(path: "/details/{id}", name: 'app_product_show')]
    public function show(Product $product, CategoryRepository $categoryRepository): Response
    {
        return $this->render("pages/catalog/product/front_show.html.twig", [
            "product" => $product,
            "categories" => $categoryRepository->findBy(['parentCategory' => null], ['name' => 'ASC']),
        ]);
    }

    #[Route(path: "/{id}", name: 'app_product_show')]
    public function adminShow(Product $product, CategoryRepository $categoryRepository): Response
    {
        return $this->render("pages/catalog/product/admin_show.html.twig", [
            "product" => $product,
            "categories" => $categoryRepository->findBy(['parentCategory' => null], ['name' => 'ASC']),
        ]);
    }


    #[Route(path: "/{id}/modifier", name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function update(Product $product, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProductCreateForm::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($product);
            $em->flush();

            $this->addFlash('succes', 'Produit modifié avec succès !');

            return $this->redirectToRoute('app_product_show', ['id' => $product->getId()]);
        }

        return $this->render("pages/catalog/product/create.html.twig", [
            'form' => $form,
            'product' => $product,
        ]);
    }
}
