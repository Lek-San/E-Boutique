<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ProduitFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Cette fonction sera chargée suite à la commande php bin/console doctrine:fixtures:load
        
        // $product = new Product();
        // $manager->persist($product);

        //Nous allons créer un tableau produitArray de plusieurs données représentant plusieurs instances de l'Entity Produit à envoyer à notre base de données. produitArray est un tableau de tableaux associatifs, chacun contenant les valeurs à remplir pour chaque champ de l'instance d'Entity
        
        $produitArray = [
            ["name" => "Table", "description" => "Ceci est une Table", "price" => 150, "stock" => 40],
            ["name" => "Chaise", "description" => "Ceci est une Chaise", "price" => 20, "stock" => 25],
            ["name" => "Armoire", "description" => "Ceci est une Armoire", "price" => 500, "stock" => 8],
            ["name" => "Bureau", "description" => "Ceci est un Bureau", "price" => 200, "stock" => 100],
            ["name" => "Lit", "description" => "Ceci est un Lit", "price" =>400, "stock" => 60],
        ];
        
        //La boucle foreach parcourt notre tableau produitArray, et à chaque tour, crée une instance de l'Entity Produit, la remplit avec les valeurs du tableau associatif actuellement parcouru, et effectue une demande de persistance. Nous aurons donc autant de demandes de persistences qu'il existe d'entrées dans notre tableau produitArray.
        foreach($produitArray as $produitData){
            $produit = new \App\Entity\Produit;
            $produit->setName($produitData['name']);
            $produit->setDescription($produitData['description']);
            $produit->setPrice($produitData['price']);
            $produit->setStock($produitData['stock']);
            $manager->persist($produit);
        }
        
        
        
        $manager->flush();
    }
}
