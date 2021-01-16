<?php

namespace App\DataFixtures;

use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Membre;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class ArticleFixture extends Fixture implements DependentFixtureInterface
{
    /**
     * Doc : https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html#sharing-objects-between-fixtures
     * @param ObjectManager $manager
     * @throws \Exception
     */
    public function load(ObjectManager $manager)
    {

    // ------------------------------------ ARTICLE I
        # Récupération d'un catégorie
        $categorie = $manager->getRepository(Categorie::class)
            ->findOneBy(['slug' => 'economie']);

        # Création d'un Article
        $article = new Article();
        $article->setTitre('"Année record" en 2018 pour l\'agriculture biologique en France, 10% des agriculteurs travaillent désormais en bio')
            ->setSlug('annee-record-en-2018-pour-l-agriculture-biologique-en-france-10-des-agriculteurs-travaillent-desormais-en-bio')
            ->setContenu("<p>Selon l'Agence Bio, qui publie cette étude, 7,5% des terres agricoles françaises sont consacrées à l'agriculture biologique.</p>")
            ->setDateCreation(new \DateTime())
            ->setFeaturedImage('19436599.jpg')
            ->setSpotlight(1)
            ->setSidebar(0)
            ->setMembre($this->getReference(MembreFixture::ARTICLE_MEMBRE_REFERENCE))
            ->setCategorie($categorie);
        $manager->persist($article);

        // ------------------------------------ ARTICLE II
        # Récupération d'un catégorie
        $categorie = $manager->getRepository(Categorie::class)
            ->findOneBy(['slug' => 'economie']);

        # Création d'un Article
        $article = new Article();
        $article->setTitre('Un automobiliste perd 150 heures par an dans les bouchons à Paris')
            ->setSlug('un-automobiliste-perd-150-heures-par-an-dans-les-bouchons-a-paris')
            ->setContenu("<p>C'est à Paris qu'il y a le plus de bouchons en France. La capitale française est loin d'être la pire en Europe et dans le monde. </p>")
            ->setDateCreation(new \DateTime())
            ->setFeaturedImage('19435639.jpg')
            ->setSpotlight(1)
            ->setSidebar(0)
            ->setMembre($this->getReference(MembreFixture::ARTICLE_MEMBRE_REFERENCE))
            ->setCategorie($categorie);
        $manager->persist($article);

        // ------------------------------------ ARTICLE III
        # Récupération d'un catégorie
        $categorie = $manager->getRepository(Categorie::class)
            ->findOneBy(['slug' => 'politique']);

        # Création d'un Article
        $article = new Article();
        $article->setTitre('Jean-Luc Mélenchon fragilisé après les européennes mais toujours en lice pour 2022')
            ->setSlug('jean-luc-melenchon-fragilise-apres-les-europeennes-mais-toujours-en-lice-pour-2022')
            ->setContenu('<p>Le chef de file de La France insoumise se "repose" et doit s\'exprimer dans quelques jours. Ses amis assurent qu\'il est toujours "la bonne personne" pour la prochaine présidentielle.</p>')
            ->setDateCreation(new \DateTime())
            ->setFeaturedImage('19436149.jpg')
            ->setSpotlight(0)
            ->setSidebar(1)
            ->setMembre($this->getReference(MembreFixture::ARTICLE_MEMBRE_REFERENCE))
            ->setCategorie($categorie);
        $manager->persist($article);

        // ------------------------------------ ARTICLE IV
        # Récupération d'un catégorie
        $categorie = $manager->getRepository(Categorie::class)
            ->findOneBy(['slug' => 'politique']);

        # Création d'un Article
        $article = new Article();
        $article->setTitre('Comment Laurent Wauquiez a été contraint de quitter la tête des Républicains')
            ->setSlug('appels-a-demission-scission-primaire-quatre-signes-que-la-tension-monte-au-sein-des-republicains')
            ->setContenu('<p>Au cœur d\'une tempête politique depuis une semaine, Laurent Wauquiez a annoncé, dimanche soir, qu\'il quittait son poste de président de parti. Franceinfo revient sur les raisons qui l\'ont poussé vers la sortie.</p>')
            ->setDateCreation(new \DateTime())
            ->setFeaturedImage('19420343.jpg')
            ->setSpotlight(0)
            ->setSidebar(1)
            ->setMembre($this->getReference(MembreFixture::ARTICLE_MEMBRE_REFERENCE))
            ->setCategorie($categorie);
        $manager->persist($article);

        // ------------------------------------ ARTICLE V
        # Récupération d'un catégorie
        $categorie = $manager->getRepository(Categorie::class)
            ->findOneBy(['slug' => 'culture']);

        # Création d'un Article
        $article = new Article();
        $article->setTitre('L\'exposition qui lève le mystère de la "Joconde nue" à Chantilly')
            ->setSlug('l-exposition-qui-leve-le-mystere-de-la-joconde-nue-a-chantilly')
            ->setContenu('<p>A l\'occasion du 500e anniversaire de la mort de Léonard de Vincy, le musée de Condé de Chantilly présente une exposition inédite consacrée à l\'une de ses oeuvres phare et méconnue : "La Joconde nue".</p>')
            ->setDateCreation(new \DateTime())
            ->setFeaturedImage('19435783.jpg')
            ->setSpotlight(0)
            ->setSidebar(0)
            ->setMembre($this->getReference(MembreFixture::ARTICLE_MEMBRE_REFERENCE))
            ->setCategorie($categorie);
        $manager->persist($article);

        // ------------------------------------ ARTICLE VI
        # Récupération d'un catégorie
        $categorie = $manager->getRepository(Categorie::class)
            ->findOneBy(['slug' => 'culture']);

        # Création d'un Article
        $article = new Article();
        $article->setTitre('L\'architecte responsable de la restauration de la cathédrale depuis 2013 appelle à refaire la flèche "à l\'identique"')
            ->setSlug('l-architecte-responsable-de-la-restauration-de-la-cathedrale-depuis-2013-appelle-a-refaire-la-fleche-a-l-identique')
            ->setContenu('<p>Après l\'incendie qui a ravagé mi-avril la cathédrale, le gouvernement a annoncé qu\'il organiserait un concours international sur la reconstruction de la flèche afin de décider si elle sera reconstruite à l\'identique ou remplacée par "un geste architectural contemporain". "Le gouvernement veut lancer un concours international. </p>')
            ->setDateCreation(new \DateTime())
            ->setFeaturedImage('19436823.jpg')
            ->setSpotlight(1)
            ->setSidebar(0)
            ->setMembre($this->getReference(MembreFixture::ARTICLE_MEMBRE_REFERENCE))
            ->setCategorie($categorie);
        $manager->persist($article);

        $manager->flush();
    }

    /**
     * This method must return an array of fixtures classes
     * on which the implementing class depends on
     * Docs : https://symfony.com/doc/current/bundles/DoctrineFixturesBundle/index.html#loading-the-fixture-files-in-order
     *
     * @return array
     */
    public function getDependencies()
    {
        return [
          CategorieFixture::class,
          MembreFixture::class
        ];
    }
}
