<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;

class CategoryController extends Controller
{
    public function indexAction(Request $request)
    {
        // une seule catégorie
        //todo: liste de catégories
        $category = new Category();

        return $this->render('AppBundle:Category:index.html.twig', array(
            'category' => $category
        ));
    }
}
