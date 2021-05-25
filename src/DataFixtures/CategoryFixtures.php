<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        //Cette fonction sera chargée suite à la commande php bin/console doctrine:fixtures:load
        
        // $product = new Product();
        // $manager->persist($product);

        //Nous allons créer un tableau produitArray de plusieurs données représentant plusieurs instances de l'Entity Produit à envoyer à notre base de données. produitArray est un tableau de tableaux associatifs, chacun contenant les valeurs à remplir pour chaque champ de l'instance d'Entity
        
        $categoryArray = [
            ["name" => "Table", "description" => "Tables"],
            ["name" => "Chaise", "description" => "Chaises"],
            ["name" => "Armoire", "description" => "Armoires"],
            ["name" => "Bureau", "description" => "Bureaus"],
            ["name" => "Lit", "description" => "Lits"],
        ];
        
        //La boucle foreach parcourt notre tableau produitArray, et à chaque tour, crée une instance de l'Entity Produit, la remplit avec les valeurs du tableau associatif actuellement parcouru, et effectue une demande de persistance. Nous aurons donc autant de demandes de persistences qu'il existe d'entrées dans notre tableau produitArray.
        foreach($categoryArray as $categoryData){
            $category = new \App\Entity\Category;
            $category->setName($categoryData['name']);
            $category->setDescription($categoryData['description']);
            $manager->persist($category);
        }
        
        
        
        $manager->flush();
    }
}
