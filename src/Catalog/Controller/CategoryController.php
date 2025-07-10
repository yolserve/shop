<?php

namespace App\Catalog\Controller;

use App\Catalog\Entity\Category;
use App\Catalog\Form\CategoryForm;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Catalog\Repository\CategoryRepository;
use App\Common\Service\FileUploaderHelper;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route(path: "/categories")]
class CategoryController extends AbstractController
{

    #[Route(path: "/", name: "app_category_list", methods: ["GET"])]
    public function categorieList(CategoryRepository $categoryRepository): Response
    {
        return $this->render("pages/catalog/category/index.html.twig", [
            "categories" => $categoryRepository->findAll(),
        ]);
    }

    #[Route(path: "/creer-une-categorie", name: "app_category_create")]
    public function create(Request $request, EntityManagerInterface $em,): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryForm::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($category);
            $em->flush();
            $this->addFlash("success", "La catégorie a été créée avec succès.");
            return $this->redirectToRoute("app_category_list");
        }

        return $this->render("pages/catalog/category/create.html.twig", [
            "form" => $form,
        ]);
    }

    #[Route(path: "/{id}", name: "app_category_show")]
    public function show(Category $category): Response
    {
        return $this->render("pages/catalog/category/show.html.twig", [
            "category" => $category,
        ]);
    }

    #[Route(path: "/{id}/edit", name: "app_category_edit")]
    public function edit(Category $category, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(CategoryForm::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute("app_category_list");
        }
        return $this->render("pages/catalog/category/edit.html.twig", [
            "category" => $category,
            "form" => $form,
        ]);
    }
}
