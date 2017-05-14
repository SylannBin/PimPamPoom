<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;

class CategoryController extends Controller
{
    public function indexAction(Request $request)
    {
        $categories = $this
            ->getDoctrine()
            ->getRepository('AppBundle:Category')
            ->findAll();

        return $this->render('AppBundle:Category:index.html.twig', array(
            'categories' => $categories
        ));
    }

    public function createAction()
    {
        return $this->render('AppBundle:Category:create.html.twig');
    }

    public function changeAction($id)
    {
        return $this->render('AppBundle:Category:change.html.twig');
    }

    public function deleteAction($id)
    {
        return $this->render('AppBundle:Category:delete.html.twig');
    }
}
