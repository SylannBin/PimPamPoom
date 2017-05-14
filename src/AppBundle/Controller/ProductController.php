<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;

class ProductController extends Controller
{
    public function indexAction(Request $request)
    {
        $products = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Product')
            ->findAll();

        return $this->render('AppBundle:Product:index.html.twig', array(
            'products' => $products
        ));
    }

    public function createAction()
    {
        return $this->render('AppBundle:Product:create.html.twig');
    }

    public function changeAction($id)
    {
        return $this->render('AppBundle:Product:change.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->render('AppBundle:Product:delete.html.twig');
    }
}
