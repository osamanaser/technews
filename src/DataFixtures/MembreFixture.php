<?php

namespace App\DataFixtures;

use App\Entity\Membre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class MembreFixture extends Fixture
{
    const ARTICLE_MEMBRE_REFERENCE = 'article-membre';

    public function load(ObjectManager $manager)
    {

        $membre = new Membre();
        $membre->setPrenom("Hugo");
        $membre->setNom("LIEGEARD");
        $membre->setEmail("admin@technews.com");
        $membre->setPassword("admin123");
        $membre->setDateInscription(new \DateTime());
        $membre->setRoles(['ROLE_ADMIN']);

        $manager->persist($membre);
        $manager->flush();

        # Partage du membre
        $this->addReference(self::ARTICLE_MEMBRE_REFERENCE, $membre);
    }
}
