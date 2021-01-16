<?php


namespace App\Controller\TechNews;


use App\Entity\Article;
use App\Entity\Categorie;
use App\Entity\Membre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class ArticleController
 * @package App\Controller\TechNews
 */
class ArticleController extends AbstractController
{
    /**
     * Démonstration de l'ajout d'un
     * Article avec Doctrine.
     * @Route("/demo/article")
     */
    public function demo()
    {
        # Création d'une Catégorie
        $categorie = new Categorie();
        $categorie->setNom("Sciences");
        $categorie->setSlug("sciences");

        # Création d'un Membre
        $membre = new Membre();
        $membre->setPrenom('Lloyd');
        $membre->setNom('Drack');
        $membre->setEmail('lloyd.d@technews.com');
        $membre->setPassword('lloyd.d');
        $membre->setDateInscription(new \DateTime());
        $membre->setRoles(['ROLE_AUTEUR']);

        # Création d'un Article
        $article = new Article();
        $article->setTitre("La Nasa prépare l'envoi d'équipements sur la Lune en 2020");
        $article->setSlug("la-nasa-prepare-l-envoi-d-equipements-sur-la-lune-en-2020");
        $article->setFeaturedImage("19418279.jpg");
        $article->setContenu("<p>Pour la première fois depuis les années 1970, les Etats-Unis vont renvoyer sur la Lune des équipements en 2020 et 2021, a annoncé la Nasa vendredi 31 mai. L'agence spatiale américaine a sélectionné trois alunisseurs pour envoyer des instruments et équipements scientifiques sur la Lune, préalablement au retour d'astronautes désiré en 2024 dans le cadre du programme Artémis.</p><p>Le premier engin (Orbit Beyond) prévoit d'alunir dans la mer des Pluies en septembre 2020, après avoir été lancé par une fusée Falcon 9 de la société SpaceX. L'alunisseur d'Intuitive Machines tentera de se poser en juillet 2021 dans l'océan des Tempêtes, qui est la plus grande tâche sombre de la Lune, visible depuis la Terre. Lui aussi sera lancé par SpaceX. Enfin, Astrobotic vise le grand cratère du lac de la Mort, en juillet 2021, à bord d'une fusée qui n'a pas encore été choisie.</p>");
        $article->setDateCreation(new \DateTime());
        $article->setSpotlight(1);
        $article->setSidebar(0);

        # -- Attribution d'un Auteur et d'une catégorie.
        $article->setMembre($membre);
        $article->setCategorie($categorie);

        /**
         * Récupération du Manager de Doctrine
         * -------------------------------------------------
         * Le EntityManager ($em) est une classe
         * qui sais comment persister d'autres classes.
         * (Effectuer des opérations CRUD sur nos Entités).
         */
        $em = $this->getDoctrine()->getManager();
        $em->persist($categorie);
        $em->persist($membre);
        $em->persist($article);
        $em->flush();

        # Retourne une réponse à la vue
        return new Response('
        Enregistrement nouvel article : '
            . $article->getId()
            . ' et la nouvelle catégorie : '
            . $categorie->getNom()
            . ' et un membre auteur : '
            . $membre->getPrenom()
        );

    }

    /**
     * Formulaire pour rédiger un Article
     * @Route("/creer-un-article",
     *     name="article_new")
     */
    public function newArticle()
    {

        # Récupération d'un Membre (Auteur)
        $membre = $this->getDoctrine()
            ->getRepository(Membre::class)
            ->find(1);

        # Création d'un nouvel article
        $article = new Article();

        # Attribution d'un Auteur au nouvel article
        $article->setMembre($membre);

        # Création du Formulaire
        $form = $this->createFormBuilder($article)
            ->add('titre', TextType::class, [
                'label' => "Titre de l'article",
                'attr' => [
                    'placeholder' => "Titre de l'article"
                ]
            ])
            ->add('categorie', EntityType::class, [
                'class' => Categorie::class,
                'choice_label' => 'nom'
            ])
            ->add('contenu', TextareaType::class, [
                'label' => false
            ])
            ->add('featuredImage', FileType::class, [
                'attr' => [
                    'class' => 'dropify'
                ]
            ])
            ->add('spotlight', CheckboxType::class, [
                'required' => false,
                'attr' => [
                    'data-toggle' => 'toggle',
                    'data-on' => 'Oui',
                    'data-off' => 'Non'
                ]
            ])
            ->add('sidebar', CheckboxType::class, [
                'required' => false,
                'attr' => [
                    'data-toggle' => 'toggle',
                    'data-on' => 'Oui',
                    'data-off' => 'Non'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Publier mon Article'
            ])
            ->getForm();

        return $this->render('article/form.html.twig', [
            'form' => $form->createView()
        ]);

    }
    
}
