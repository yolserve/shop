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
    public function create(Request $request, EntityManagerInterface $em, FileUploaderHelper $fileUploader): Response
    {
        $brand = new Brand();
        $form = $this->createForm(BrandForm::class, $brand);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            // dd($form['thumbnailFile']->getData(), $request);

            $thumbnailFilename = $fileUploader->uploadLogoImage($form['logoFile']->getData());
            $brand->setLogoUrl($thumbnailFilename);

            $em->persist($brand);
            $em->flush();
            $this->addFlash("success", "La catégorie a été créée avec succès.");
            return $this->redirectToRoute("app_category_list");
        }

        return $this->render("pages/catalog/brand/create.html.twig", [
            "form" => $form,
        ]);
    }
}
