<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Category;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CategoryController extends Controller
{
  /**
   * Display all existing categories of the database
   *
   */
  public function indexAction(Request $request)
  {
    // Get the categories
    $categories = $this
      ->getDoctrine()
      ->getRepository('AppBundle:Category')
      ->findAll();

    // Render the view
    return $this->render('AppBundle:Category:index.html.twig', array(
      'categories' => $categories
    ));
  }

  /**
   * Add a category into the database
   *
   */
  public function createAction(Request $request)
  {
    // Shortcut the entity manager
    $em = $this->getDoctrine()->getManager();

    // Empty Category
    $category = new Category();

    // Build the form
    $form = $this
      ->createFormBuilder($category)
      ->add('labelEn', TextType::class, array('required' => false))
      ->add('labelFr', TextType::class, array('required' => false))
      ->add('labelDe', TextType::class, array('required' => false))
      ->add('save', SubmitType::class)
      ->getForm();

    // If no errors
    if ($form->handleRequest($request)->isValid()) {
      // Update the database
      $em->persist($category);
      $em->flush();

      // Notify the view
      $request
        ->getSession()
        ->getFlashBag()
        ->add('notice', 'Category registered successfully.');

      // Redirect to main page
      return $this->redirect($this->generateUrl('app_categories'));
    }
    // Render the form
    return $this->render('AppBundle:Category:create.html.twig', array(
        'form' => $form->createView(),
    ));
  }

  /**
   * Delete a category from the database
   *
   */
  public function deleteAction($id, Request $request)
  {
    // Shortcut the entity manager
    $em = $this->getDoctrine()->getManager();

    // Get Category
    $category = $em
      ->getRepository('AppBundle:Category')
      ->find($id);

    // Handle null category
    if (null === $category) {
      throw new NotFoundHttpException("No category with id=".$id." were found.");
    }

    // Build the form
    $form = $this
      ->createFormBuilder()
      ->getForm();

    // If no errors
    if ($form->handleRequest($request)->isValid()) {
      // Update database
      $em->remove($category);
      $em->flush();
      // Notify the view
      $request
        ->getSession()
        ->getFlashBag()
        ->add('info', "Category deleted successfully.");
      // Redirect to main page
      return $this->redirect($this->generateUrl('app_categories'));
    }
    // Render delete confirmation page
    return $this->render('AppBundle:Category:delete.html.twig', array(
      'category' => $category,
      'form'   => $form->createView()
    ));
  }

  /**
   * Change a category in the database
   *
   */
  public function changeAction($id, Request $request)
  {
    // Shortcut the entity manager
    $em = $this->getDoctrine()->getManager();

    // Get Category
    $category = $em
      ->getRepository('AppBundle:Category')
      ->find($id);

    // Handle null category
    if (null === $category) {
      throw new NotFoundHttpException("No category with id=".$id." were found.");
    }

    // Build the form
    $form = $this->createFormBuilder($category)
      ->add('labelEn', TextType::class, array('required' => false))
      ->add('labelFr', TextType::class, array('required' => false))
      ->add('labelDe', TextType::class, array('required' => false))
      ->add('save', SubmitType::class)
      ->getForm();

    // If no errors
    if ($form->handleRequest($request)->isValid()) {
      // Update database
      $em->flush();
      // notify on view
      $request
        ->getSession()
        ->getFlashBag()
        ->add('notice', 'Category changed successfully.');
      // redirect to main page
      return $this->redirect($this->generateUrl('app_categories', array(
        'id' => $category->getId()
      )));
    }
    // Else: Render a new form
    return $this->render('AppBundle:Category:change.html.twig', array(
      'form'   => $form->createView(),
      'category' => $category
    ));
  }
}
