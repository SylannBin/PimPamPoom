<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Product;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

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
public function createAction(Request $request)

  {

    // On crée un objet Product

    $product = new Product();


  

    $form = $this->createFormBuilder($product)


      ->add('category',     IntegerType::class)   

      ->add('labelEn',     TextType::class, array('required' => false))

      ->add('labelFr',     TextType::class, array('required' => false))

      ->add('labelDe',     TextType::class, array('required' => false))

      ->add('descriptionEn',     TextareaType::class, array('required' => false))

      ->add('descriptionFr',     TextareaType::class, array('required' => false))

      ->add('descriptionDe',     TextareaType::class, array('required' => false))

      ->add('technicalEn',     TextareaType::class, array('required' => false))

      ->add('technicalFr',     TextareaType::class, array('required' => false))

      ->add('technicalDe',     TextareaType::class, array('required' => false))

      ->add('price',     TextType::class)

      ->add('save',       SubmitType::class)
    
            ->getForm();


	$form->handleRequest($request);


    // On vérifie que les valeurs entrées sont correctes

    // (Nous verrons la validation des objets en détail dans le prochain chapitre)

    if ($form->isValid()) {

      // On l'enregistre notre objet $product dans la base de données, par exemple

      $em = $this->getDoctrine()->getManager();

      $em->persist($product);

      $em->flush();


      $request->getSession()->getFlashBag()->add('notice', 'Produit enregistrée.');


      // On redirige vers la page de visualisation de l'annonce nouvellement créée

      return $this->redirect($this->generateUrl('app_products'));

    }

        return $this->render('AppBundle:Product:create.html.twig', array(
            'form' => $form->createView(),
        ));

  }


 public function deleteAction($id, Request $request)

  {

    $em = $this->getDoctrine()->getManager();


    // On récupère l'annonce $id

    $product = $em->getRepository('AppBundle:Product')->find($id);


    if (null === $product) {

      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");

    }


    // On crée un formulaire vide, qui ne contiendra que le champ CSRF

    // Cela permet de protéger la suppression d'annonce contre cette faille

    $form = $this->createFormBuilder()->getForm();


    if ($form->handleRequest($request)->isValid()) {

      $em->remove($product);

      $em->flush();


      $request->getSession()->getFlashBag()->add('info', "Le produit a bien été supprimée.");


      return $this->redirect($this->generateUrl('app_products'));

    }


    // Si la requête est en GET, on affiche une page de confirmation avant de supprimer

    return $this->render('AppBundle:Product:delete.html.twig', array(

      'product' => $product,

      'form'   => $form->createView()

    ));

  }

public function changeAction($id, Request $request)

  {

    $em = $this->getDoctrine()->getManager();


    // On récupère l'annonce $id

    $product = $em->getRepository('AppBundle:Product')->find($id);


    if (null === $product) {

      throw new NotFoundHttpException("L'annonce d'id ".$id." n'existe pas.");

    }


   $form = $this->createFormBuilder($product)

      ->add('category',     IntegerType::class)   

      ->add('labelEn',     TextType::class, array('required' => false))

      ->add('labelFr',     TextType::class, array('required' => false))

      ->add('labelDe',     TextType::class, array('required' => false))

      ->add('descriptionEn',     TextareaType::class, array('required' => false))

      ->add('descriptionFr',     TextareaType::class, array('required' => false))

      ->add('descriptionDe',     TextareaType::class, array('required' => false))

      ->add('technicalEn',     TextareaType::class, array('required' => false))

      ->add('technicalFr',     TextareaType::class, array('required' => false))

      ->add('technicalDe',     TextareaType::class, array('required' => false))

      ->add('price',     TextType::class)

      ->add('save',       SubmitType::class)
    
            ->getForm();


    if ($form->handleRequest($request)->isValid()) {

      // Inutile de persister ici, Doctrine connait déjà notre annonce

      $em->flush();


      $request->getSession()->getFlashBag()->add('notice', 'Produit modifiée.');


      return $this->redirect($this->generateUrl('app_products', array('id' => $product->getId())));

    }


    return $this->render('AppBundle:Product:change.html.twig', array(

      'form'   => $form->createView(),

      'Product' => $product // Je passe également l'annonce à la vue si jamais elle veut l'afficher

    ));

  }
}
