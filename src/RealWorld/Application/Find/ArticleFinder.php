<?php

declare(strict_types = 1);

namespace RealWorld\Application\Find;

use RealWorld\Application\Find\FindArticleBySlugQuery;
use RealWorld\Domain\Exceptions\ArticleNotFoundException;
use RealWorld\Infrastructure\Repository\ArticleRepository;
use RealWorld\Domain\Entities\Article;

final class ArticleFinder
{
    
    /** @var ArticleRepository */
    private $repository;
    
    public function __construct(ArticleRepository $repository)
    {
        $this->repository = $repository;
    }
    
    /**
    * Finds Article by slug.
    *
    * @throws ArticleNotFoundException
    * 
    * @param FindArticleBySlugQuery $query
    * @return Article|null
    */  
    public function __invoke(FindArticleBySlugQuery $query): ?Article
    {
        $slug = $query->slug();
        
        $article = $this->repository->findOneBySlug($slug);
        
        $this->ensureArticleExists($slug, $article);
        
        return $article;
    }
    
    private function ensureArticleExists(string $slug, Article $article = null): void
    {
        if (null === $article) {
            throw new ArticleNotFoundException($slug);
        }
    }
    
}