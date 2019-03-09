<?php

declare(strict_types = 1);

namespace RealWorld\Blog\Article\Application\Find;

use RealWorld\Blog\Article\Application\Find\FindArticleBySlugQuery;
use RealWorld\Blog\Article\Infrastructure\Persistence\ArticleRepositoryArray;
use RealWorld\Blog\Article\Domain\Article;
use RealWorld\Blog\Article\Domain\ArticleSlug;
use RealWorld\Blog\Article\Domain\ArticleSlugNotFound;

final class ArticleFinder
{

    /** @var ArticleRepositoryArray */
    private $repository;

    public function __construct(ArticleRepositoryArray $repository)
    {
        $this->repository = $repository;
    }

    /**
    * Finds Article by slug.
    *
    * @throws ArticleSlugNotFound
    * 
    * @param FindArticleBySlugQuery $query
    * @return Article|null
    */  
    public function search(FindArticleBySlugQuery $query): ?Article
    {
        $slug = new ArticleSlug($query->slug());
        
        $article = $this->repository->searchBySlug($slug);
        
        $this->ensureArticleExists($slug, $article);
        
        return $article;
    }

    private function ensureArticleExists(ArticleSlug $slug, Article $article = null): void
    {
        if (null === $article) {
            throw new ArticleSlugNotFound($slug);
        }
    }

}