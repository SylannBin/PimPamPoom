<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        // Get all products
        $products = $this->getDoctrine()->getRepository("AppBundle:Product")->findAll();

        // Get all categories
        $categories = $this->getDoctrine()->getRepository("AppBundle:Category")->findAll();

        // Render the view
        return $this->render('AppBundle:Default:index.html.twig', array(
            "nbProducts" => count($products),
            "nbCategories" => count($categories)
        ));
    }
}
