<?php


namespace App\Service\Article;


use Symfony\Component\Yaml\Exception\ParseException;
use Symfony\Component\Yaml\Yaml;

/**
 * Class ArticlesProvider
 * @package App\Service\Article
 */
class ArticlesProvider
{
    /**
     * Retourne les articles du fichier
     * articles.yaml sous forme de tableau PHP.
     */
    public function getArticles(): array
    {
        try {
            return Yaml::parseFile(__DIR__ . '/articles.yaml');
        } catch (ParseException $exception) {
            printf('Unable to parse the YAML string: %s', $exception->getMessage());
        }
    }
}
