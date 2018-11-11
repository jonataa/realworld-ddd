<?php

namespace RealWorld\Infrastructure\Repository;

use RealWorld\Domain\Entities\Article;

final class ArticleArrayRepository
{

  /** @var Article[] */
  protected $rows = [];

  public function __construct(array $rows = [])
  {
    $this->rows = $rows;
  }

  public function findOneBySlug(string $slug): Article
  {
    $filtered = array_filter($this->rows, function($article) use ($slug) {
      return $article->getSlug() === $slug;
    });
    
    return current($filtered);
  }

}