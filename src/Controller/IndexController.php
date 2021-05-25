<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Form\ProduitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        return $this->render('index/index.html.twig');
    }
    
    /**
     * 
     * @Route("/produit/add", name="produit_add")
     */
    public function addProduit(Request $request){
        //Formulaire de produit: Nous faisons d'abord appel à l'Entity Manager
        //Nous créons une nouvelle Entity Produit, lié à un nouveau formulaire ProduitType
        //Si le formulaire est rempli, dans une structure if, nous procédons à la persistance de l'objet
        $entityManager = $this->getDoctrine()->getManager();
        //Création du produit et du formulaire de notre fonction
        $produit = new Produit;
        $produitForm = $this->createForm(ProduitType::class, $produit);
        //Gestion de la requête par notre formulaire
        $produitForm->handleRequest($request);
        //Si notre formulaire est valide, demande de persistance et retour à l'index
        if($request->isMethod('post') && $produitForm->isValid()){
            $entityManager->persist($produit);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('index'));
        }
        //Si le formulaire n'est pas rempli, nous l'affichons via ce render()
        return $this->render('index/dataform.html.twig', [
            'dataForm' => $produitForm->createView(),
        ]);
    }
    
    /**
     * @Route("/produit/edit/{produitId}", name="produit_edit")
     */
    public function editProduit(Request $request, $produitId = ""){
        //Formulaire de modification de produit: Nous faisons d'abord appel à l'Entity Manager
        //Nous récupérons ensuite le Produit concerné via son Id, via le produitRepository
        //Nous lions le Produit récupéré de notre BDD à un nouveau formulaire ProduitType
        //Si le formulaire est rempli, dans une structure if, nous procédons à la persistance de l'objet
        $entityManager = $this->getDoctrine()->getManager();
        $produitRepository = $entityManager->getRepository(Produit::class);
        //Récupération du produit et du formulaire de notre fonction, retour vers l'index si aucun résultat
        $produit = $produitRepository->find($produitId);
        if(!$produit){
            return $this->redirect($this->generateUrl('index'));
        }
        $produitForm = $this->createForm(ProduitType::class, $produit);
        //Gestion de la requête par notre formulaire
        $produitForm->handleRequest($request);
        //Si notre formulaire est valide, demande de persistance et retour à l'index
        if($request->isMethod('post') && $produitForm->isValid()){
            $entityManager->persist($produit);
            $entityManager->flush();
            return $this->redirect($this->generateUrl('index'));
        }
        //Si le formulaire n'est pas rempli, nous l'affichons via ce render()
        return $this->render('index/dataform.html.twig', [
            'dataForm' => $produitForm->createView(),
        ]);
    }
    
}
