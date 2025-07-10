<?php

namespace App\Catalog\Controller;

use App\Catalog\Entity\Brand;
use App\Catalog\Form\BrandForm;
use Doctrine\ORM\EntityManagerInterface;
use App\Common\Service\FileUploaderHelper;
use App\Catalog\Repository\BrandRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


#[Route(path: "/marques")]
class BrandController extends AbstractController
{

    #[Route(path: "/", name: "app_brand_list", methods: ["GET"])]
    public function categorieList(BrandRepository $brandRepository): Response
    {
        return $this->render("pages/catalog/brand/index.html.twig", [
            "brands" => $brandRepository->findAll(),
        ]);
    }

    #[Route(path: "/creer-une-marque", name: "app_brand_create")]
    public function create(Request $request, EntityManagerInterface $em,): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandForm::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $em->persist($brand);
            $em->flush();
            $this->addFlash("success", "La catégorie a été créée avec succès.");
            return $this->redirectToRoute("app_category_list");
        }

        return $this->render("pages/catalog/brand/create.html.twig", [
            "form" => $form,
        ]);
    }

    #[Route(path: "/{id}", name: "app_brand_show")]
    public function show(Brand $brand): Response
    {
        return $this->render("pages/catalog/brand/show.html.twig", [
            "brand" => $brand,
        ]);
    }

    #[Route(path: "/{id}/edit", name: "app_brand_edit")]
    public function edit(Brand $brand, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(BrandForm::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($brand);
            $em->flush();
            return $this->redirectToRoute("app_brand_list");
        }
        return $this->render("pages/catalog/brand/edit.html.twig", [
            "brand" => $brand,
            "form" => $form,
        ]);
    }
}
