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

public function createAction(Request $request)

  {

    // On crée un objet Category

    $category = new Category();


  

    $form = $this->createFormBuilder($category)



      ->add('labelEn',     TextType::class, array('required' => false))

      ->add('labelFr',     TextType::class, array('required' => false))

      ->add('labelDe',     TextType::class, array('required' => false))

      ->add('save',       SubmitType::class)
    
            ->getForm();


	$form->handleRequest($request);


    // On vérifie que les valeurs entrées sont correctes

    // (Nous verrons la validation des objets en détail dans le prochain chapitre)

    if ($form->isValid()) {

      // On l'enregistre notre objet $category dans la base de données, par exemple

      $em = $this->getDoctrine()->getManager();

      $em->persist($category);

      $em->flush();


      $request->getSession()->getFlashBag()->add('notice', 'Catégorie enregistrée.');


      // On redirige vers la page de visualisation de l'annonce nouvellement créée

      return $this->redirect($this->generateUrl('app_categories'));

    }

        return $this->render('AppBundle:Category:create.html.twig', array(
            'form' => $form->createView(),
        ));

  }


 public function deleteAction($id, Request $request)

  {

    $em = $this->getDoctrine()->getManager();


    // On récupère l'annonce $id

    $category = $em->getRepository('AppBundle:Category')->find($id);


    if (null === $category) {

      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");

    }


    // On crée un formulaire vide, qui ne contiendra que le champ CSRF

    // Cela permet de protéger la suppression d'annonce contre cette faille

    $form = $this->createFormBuilder()->getForm();


    if ($form->handleRequest($request)->isValid()) {

      $em->remove($category);

      $em->flush();


      $request->getSession()->getFlashBag()->add('info', "L'annonce a bien été supprimée.");


      return $this->redirect($this->generateUrl('app_categories'));

    }


    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer

    return $this->render('AppBundle:Category:delete.html.twig', array(

      'category' => $category,

      'form'   => $form->createView()

    ));

  }

public function changeAction($id, Request $request)

  {

    $em = $this->getDoctrine()->getManager();


    // On récupère l'annonce $id

    $category = $em->getRepository('AppBundle:Category')->find($id);


    if (null === $category) {

      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");

    }


   $form = $this->createFormBuilder($category)



      ->add('labelEn',     TextType::class, array('required' => false))

      ->add('labelFr',     TextType::class, array('required' => false))

      ->add('labelDe',     TextType::class, array('required' => false))

      ->add('save',       SubmitType::class)
    
            ->getForm();


    if ($form->handleRequest($request)->isValid()) {

      // Inutile de persister ici, Doctrine connait déjà notre annonce

      $em->flush();


      $request->getSession()->getFlashBag()->add('notice', 'Catégorie modifiée.');


      return $this->redirect($this->generateUrl('app_categories', array('id' => $category->getId())));

    }


    return $this->render('AppBundle:Category:change.html.twig', array(

      'form'   => $form->createView(),

      'Category' => $category // Je passe également l'annonce à la vue si jamais elle veut l'afficher

    ));

  }
}
