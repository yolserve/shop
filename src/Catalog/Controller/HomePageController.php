<?php

namespace App\Catalog\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Attribute\Route;

class HomePageController extends AbstractController
{
    #[Route(path: "/", name: "app_home")]
    public function index(): Response
    {
        return $this->render("pages/catalog/home_page/index.html.twig");
    }
}
