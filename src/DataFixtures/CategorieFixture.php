<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CategorieFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        # Politique
        $categorie = new Categorie();
        $categorie->setNom("Politique")
                  ->setSlug('politique');
        $manager->persist($categorie);

        # Economie
        $categorie = new Categorie();
        $categorie->setNom("Economie")
                  ->setSlug('economie');
        $manager->persist($categorie);

        # Culture
        $categorie = new Categorie();
        $categorie->setNom("Culture")
            ->setSlug('culture');
        $manager->persist($categorie);

        # Sports
        $categorie = new Categorie();
        $categorie->setNom("Sports")
            ->setSlug('sports');
        $manager->persist($categorie);

        # Déclenche l'execution de la requète.
        $manager->flush();
    }
}
