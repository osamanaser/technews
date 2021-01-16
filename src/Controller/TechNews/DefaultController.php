<?php


namespace App\Controller\TechNews;


use App\Entity\Article;
use App\Entity\Categorie;
use App\Service\Article\ArticlesProvider;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class DefaultController
 * @package App\Controller\TechNews
 */
class DefaultController extends AbstractController
{

    /**
     * Page d'Accueil
     * @param ArticlesProvider $articlesProvider
     * @return Response
     */
    public function index(ArticlesProvider $articlesProvider)
    {
        # Récupérer les Articles du fichier articles.yaml
        # $articles = $articlesProvider->getArticles();

        # Récupérer les Articles de la BDD
        $articles = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findAll();

        $spotlight = $this->getDoctrine()
            ->getRepository(Article::class)
            ->findBySpotlight();

        # Transmission des données à la vue
        return $this->render('default/index.html.twig', [
            'articles' => $articles,
            'spotlight' => $spotlight
        ]);
    }

    /**
     * Page de Contact
     */
    public function contact()
    {
        return new Response("
            <html><body><h1>PAGE CONTACT</h1></body></html>
        ");
    }

    /**
     * Page Catégorie
     * @Route("/categorie/{slug<[a-zA-Z0-9_/-]+>}",
     *     defaults={"slug" = "depeches"},
     *     methods={"GET"},
     *     name="default_categorie")
     * @param Categorie $categorie
     * @return Response
     */
    public function categorie(Categorie $categorie)
    {

        # Méthode 1
        # $categorie = $this->getDoctrine()
        #     ->getRepository(Categorie::class)
        #     ->findOneBy(['slug' => $slug]);
        # $articles = $categorie->getArticles();

        # Méthode 2
        # $articles = $this->getDoctrine()
        #     ->getRepository(Categorie::class)
        #     ->findOneBySlug($slug)
        #     ->getArticles();

        # Méthode 3
        $articles = $categorie->getArticles();

        return $this->render('default/categorie.html.twig', [
            'articles' => $articles,
            'categorie' => $categorie
        ]);
    }

    /**
     * Page Article
     * @Route("/{categorie<[a-zA-Z0-9_/-]+>}/{slug<[a-zA-Z0-9_/-]+>}_{id<\d+>}.html",
     *     name="default_article")
     * @param Article $article
     * @param $id
     * @return Response
     */
    public function article(Article $article, $id)
    {
        # http://localhost:8000/politique/macron-au-plus-bas-dans-les-sondages_456456.html
        # return new Response("
        #     <html>
        #         <body>
        #             <h1>PAGE ARTICLE : $id</h1>
        #             <h2>$slug</h2>
        #             <h3>$categorie</h3>
        #         </body>
        #     </html>
        # ");

        # Méthode 1
        # $article = $this->getDoctrine()
        #     ->getRepository(Article::class)
        #     ->find($id);

        return $this->render('default/article.html.twig', [
            'article' => $article
        ]);
    }

    /**
     * Gérer l'affichage de la sidebar
     */
    public function sidebar()
    {
        # Récupération du Repository
        $repository = $this->getDoctrine()
            ->getRepository(Article::class);

        # Récupérer les 5 derniers articles
        $articles = $repository->findLatest();

        # Récupérer les articles "en avant"
        $sidebar = $repository->findBySidebar();

        # Rendu de la vue
        return $this->render('components/_sidebar.html.twig', [
            'articles' => $articles,
            'sidebar' => $sidebar
        ]);
    }

}
