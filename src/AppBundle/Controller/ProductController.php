<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;

class ProductController extends Controller
{
    public function indexAction(Request $request)
    {
        // un seul produit
        //todo: liste de produits
        $product = new Product();

        return $this->render('AppBundle:Product:index.html.twig', array(
            'product' => $product
        ));
    }
}
