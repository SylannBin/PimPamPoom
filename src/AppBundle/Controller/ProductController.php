<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use AppBundle\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProductController extends Controller
{
  /**
   * Display all existing products
   *
   */
  public function indexAction(Request $request)
  {
    // Get the product's list
    $products = $this
      ->getDoctrine()
      ->getRepository('AppBundle:Product')
      ->findAll();

    // Render the view
    return $this->render('AppBundle:Product:index.html.twig', array(
      'products' => $products
    ));
  }

  /**
   * Create a product and add it to the database
   *
   */
  public function createAction(Request $request)
  {
    // Shortcut the entity manager
    $em = $this->getDoctrine()->getManager();

    // Get all categories
    $categories = $this
      ->getDoctrine()
      ->getRepository('AppBundle:Category')
      ->findAll();

    // Empty Product
    $product = new Product();

    // Build the Product form
    $form = $this
      ->prepareProduct($product, $categories);

    // If no errors
    if ($form->handleRequest($request)->isValid()) {
      // Update the database
      $em->persist($product);
      $em->flush();
      // Notify the view
      $request
        ->getSession()
        ->getFlashBag()
        ->add('notice', 'Product registered.');
      // Redirect to main page
      return $this->redirect($this->generateUrl('app_products'));
    }
    // Render the view
    return $this->render('AppBundle:Product:create.html.twig', array(
      'form' => $form->createView()
    ));
  }

  /**
   * Delete a product from the database
   *
   */
  public function deleteAction($id, Request $request)
  {
    // Shortcut the entity manager
    $em = $this->getDoctrine()->getManager();

    // Get the product with $id
    $product = $em
      ->getRepository('AppBundle:Product')
      ->find($id);

    // Handle null product
    if (null === $product) {
      throw new NotFoundHttpException("No product with id=".$id." were found.");
    }

    // Build the Product form
    $form = $this
      ->createFormBuilder()
      ->getForm();

    // If no errors
    if ($form->handleRequest($request)->isValid()) {
      // Update the database
      $em->remove($product);
      $em->flush();
      // Notify the view
      $request
        ->getSession()
        ->getFlashBag()
        ->add('info', "The product has been deleted.");
      // Redirect to main page
      return $this->redirect($this->generateUrl('app_products'));
    }

    // If it is a GET request, show a confirmation page
    return $this->render('AppBundle:Product:delete.html.twig', array(
      'product' => $product,
      'form'   => $form->createView()
    ));
  }

  /**
   * Modify a product
   *
   */
  public function changeAction($id, Request $request)
  {
    // Shortcut the entity manager
    $em = $this->getDoctrine()->getManager();

    // Get all categories
    $categories = $this
      ->getDoctrine()
      ->getRepository('AppBundle:Category')
      ->findAll();

    // Get the product with $id
    $product = $em
      ->getRepository('AppBundle:Product')
      ->find($id);

    // Handle null product
    if (null === $product) {
      throw new NotFoundHttpException("No product with id=".$id." were found.");
    }

    // Build the Product form
    $form = $this
      ->prepareProduct($product, $categories);

    // If no errors
	  if ($form->handleRequest($request)->isValid()) {
      // Update the database
		  $em->flush();
      // Notify the view
      $request
        ->getSession()
        ->getFlashBag()
        ->add('notice', 'Product modified.');
      // Redirect to main page
		  return $this->redirect($this->generateUrl('app_products', array('id' => $product->getId())));
    }

    // Else render a new form
    return $this->render('AppBundle:Product:change.html.twig', array(
      'form'    => $form->createView(),
      'Product' => $product
    ));
  }


  /**
   * Build a full product form
   *
   */
  private function prepareProduct($product, $categories)
  {
    return $this
      ->createFormBuilder($product)
      ->add('category',      ChoiceType::class, array(
        'placeholder' => 'No category',
        'required' => false,
        'choices'  => $categories,
        'choice_label' => function($category, $key, $index) {
          return $category->getLabelEn();
        }
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
  }
}
