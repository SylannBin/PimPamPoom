<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {
        $nbProducts = 10;
        $nbCategories = 10;


       return $this->render('AppBundle:Default:index.html.twig', array(
           "nbProducts" => $nbProducts,
           "nbCategories" => $nbCategories
       ));
    }
}
