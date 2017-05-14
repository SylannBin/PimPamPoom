<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductController extends Controller
{
  public function indexAction(Request $request)
  {
    // Get the product's list
    $products = $this
      ->getDoctrine()
      ->getRepository('AppBundle:Product')
      ->findAll();

    // Send the list to the view
    return $this->render('AppBundle:Product:index.html.twig', array(
        'products' => $products
    ));
  }

  // Create a product and add it to the database
  public function createAction(Request $request)
  {
    $categories = $this
      ->getDoctrine()
      ->getRepository('AppBundle:Category')
      ->findAll();

    $product = new Product();

    $form = $this->createFormBuilder($product)
      ->add('category',      ChoiceType::class, array(
        'label' => "Category",
        'choices'  => array($categories)
      ))
      ->add('labelEn',           TextType::class, array('required' => false))
      ->add('labelFr',           TextType::class, array('required' => false))
      ->add('labelDe',           TextType::class, array('required' => false))
      ->add('descriptionEn',     TextareaType::class, array('required' => false))
      ->add('descriptionFr',     TextareaType::class, array('required' => false))
      ->add('descriptionDe',     TextareaType::class, array('required' => false))
      ->add('technicalEn',       TextareaType::class, array('required' => false))
      ->add('technicalFr',       TextareaType::class, array('required' => false))
      ->add('technicalDe',       TextareaType::class, array('required' => false))
      ->add('price',             TextType::class)
      ->add('save',              SubmitType::class)
      ->getForm();

    $form->handleRequest($request);

    // Verify if the values are fine
    if ($form->isValid()) {
      // Register the values in the product to the data base
      $em = $this->getDoctrine()->getManager();
      $em->persist($product);
      $em->flush();

      $request
        ->getSession()
        ->getFlashBag()
        ->add('notice', 'Product registered.');
      // Redirect to the product page
      return $this->redirect($this->generateUrl('app_products'));
    }
    // Render the view
    return $this->render('AppBundle:Product:create.html.twig', array(
        'form' => $form->createView(),
    ));
  }

  // Delete a product from the database
  public function deleteAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    // Get the product with $id
    $product = $em->getRepository('AppBundle:Product')->find($id);

    if (null === $product) {
      throw new NotFoundHttpException("No product with id=".$id." were found.");
    }

    $form = $this->createFormBuilder()->getForm();

    if ($form->handleRequest($request)->isValid()) {
      $em->remove($product);
      $em->flush();
      $request->getSession()->getFlashBag()->add('info', "The product has been deleted.");

      return $this->redirect($this->generateUrl('app_products'));
    }

    // If it is a GET request, show a confirmation page
    return $this->render('AppBundle:Product:delete.html.twig', array(
      'product' => $product,
      'form'   => $form->createView()
    ));
  }

  // Modify a product
  public function changeAction($id, Request $request)
  {
    $em = $this->getDoctrine()->getManager();

    $categories = $this
      ->getDoctrine()
      ->getRepository('AppBundle:Category')
      ->findAll();

    // Get the product with $id
    $product = $em
      ->getRepository('AppBundle:Product')
      ->find($id);

    if (null === $product) {
      throw new NotFoundHttpException("No product with id=".$id." were found.");
    }

    $form = $this
      ->createFormBuilder($product)
      ->add('category',      ChoiceType::class, array(
        'label' => "Category",
        'choices'  => array($categories)
      ))
      ->add('labelEn',       TextType::class, array('required' => false))
      ->add('labelFr',       TextType::class, array('required' => false))
      ->add('labelDe',       TextType::class, array('required' => false))
      ->add('descriptionEn', TextareaType::class, array('required' => false))
      ->add('descriptionFr', TextareaType::class, array('required' => false))
      ->add('descriptionDe', TextareaType::class, array('required' => false))
      ->add('technicalEn',   TextareaType::class, array('required' => false))
      ->add('technicalFr',   TextareaType::class, array('required' => false))
      ->add('technicalDe',   TextareaType::class, array('required' => false))
      ->add('price',         TextType::class)
      ->add('save',          SubmitType::class)
      ->getForm();

	  if ($form->handleRequest($request)->isValid()) {
		  $em->flush();

      $request
        ->getSession()
        ->getFlashBag()
        ->add('notice', 'Product modified.');

		  return $this->redirect($this->generateUrl('app_products', array('id' => $product->getId())));
    }

    return $this->render('AppBundle:Product:change.html.twig', array(
      'form'    => $form->createView(),
      'Product' => $product
    ));
  }
}