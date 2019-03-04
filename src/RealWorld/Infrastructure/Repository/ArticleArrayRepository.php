<?php

declare(strict_types = 1);

namespace RealWorld\Infrastructure\Repository;

use RealWorld\Domain\Entities\Article;
use function Lambdish\phunctional\first;

class ArticleArrayRepository implements ArticleRepository
{

  /** @var Article[] */
  protected $rows = [];

  public function __construct(array $rows = [])
  {
    $this->rows = $rows;
  }

  public function findOneBySlug(string $slug): ?Article
  {
    $filtered = array_filter($this->rows, function($article) use ($slug) {
      return $article->getSlug() === $slug;
    });
    
    return first($filtered);
  }

}